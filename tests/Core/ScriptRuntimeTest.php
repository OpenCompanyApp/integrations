<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Core;

use OpenCompany\IntegrationCore\Contracts\ScriptToolInvoker;
use OpenCompany\IntegrationCore\Script\ScriptBridge;
use OpenCompany\IntegrationCore\Script\ScriptBridgeException;
use OpenCompany\IntegrationCore\Script\ScriptCatalogBuilder;
use OpenCompany\IntegrationCore\Script\ScriptDocRenderer;
use PHPUnit\Framework\TestCase;

/**
 * Protects the shared, language-neutral Code Mode catalog and dispatch boundary.
 *
 * These tests deliberately use an in-memory host adapter: the core package must
 * validate script input and describe effects without owning credentials,
 * tenancy, authorization, provider I/O, or mruby itself.
 */
final class ScriptRuntimeTest extends TestCase
{
    public function test_colliding_short_names_never_overwrite_a_different_endpoint(): void
    {
        $builder = new ScriptCatalogBuilder;
        $tools = [
            ['slug' => 'records_list_all', 'name' => 'List Records', 'parameters' => [['name' => 'limit', 'type' => 'integer']]],
            ['slug' => 'records_list_owned', 'name' => 'List Records', 'parameters' => [['name' => 'owner', 'type' => 'string']]],
            // A display name must not steal another endpoint's exact slug.
            ['slug' => 'records_shadow', 'name' => 'Records List All', 'parameters' => []],
        ];
        $namespaces = $builder->buildNamespaces([['name' => 'records', 'isIntegration' => true, 'accounts' => ['work'], 'tools' => $tools]]);
        $map = $builder->buildFunctionMap($namespaces);
        self::assertArrayNotHasKey('integrations.records.list', $map);
        foreach ($tools as $tool) {
            self::assertSame($tool['slug'], $map['integrations.records.'.$tool['slug']]);
            self::assertSame('work', $builder->buildAccountMap($namespaces)['integrations.records.work.'.$tool['slug']]);
        }
        self::assertSame('owner', $builder->buildParameterMap($namespaces)['integrations.records.records_list_owned'][0]['name']);

        // Removing permissions changes discovery, never the exact operation path.
        $subset = $builder->buildNamespaces([['name' => 'records', 'isIntegration' => true, 'tools' => [$tools[1]]]]);
        self::assertSame('records_list_owned', $builder->buildFunctionMap($subset)['integrations.records.records_list_owned']);
        self::assertArrayNotHasKey('integrations.records.records_list_all', $builder->buildFunctionMap($subset));
    }

    public function test_exact_tool_names_are_reserved_before_assigning_short_names(): void
    {
        $builder = new ScriptCatalogBuilder;
        self::assertSame(['lookup' => 'get', 'other' => 'other'], $builder->functionNames([
            ['slug' => 'lookup', 'name' => 'Get'], ['slug' => 'other', 'name' => 'Lookup'],
        ], 'records'));
    }

    public function test_catalog_preserves_schema_effect_and_return_metadata(): void
    {
        $catalog = [[
            'name' => 'weather',
            'description' => 'Weather data',
            'isIntegration' => true,
            'accounts' => ['work'],
            'tools' => [[
                'slug' => 'weather_forecast',
                'name' => 'Weather Forecast',
                'description' => 'Read a forecast.',
                'type' => 'read',
                'parameters' => [[
                    'name' => 'postalCode',
                    'type' => 'string',
                    'required' => true,
                    'description' => 'Fake postal code.',
                ]],
                'returns' => [
                    'type' => 'object',
                    'properties' => ['temperature' => ['type' => 'number']],
                ],
            ]],
        ]];

        $builder = new ScriptCatalogBuilder;
        $namespaces = $builder->buildNamespaces($catalog);

        self::assertArrayHasKey('integrations.weather', $namespaces);
        self::assertArrayHasKey('integrations.weather.default', $namespaces);
        self::assertSame('work', $namespaces['integrations.weather.work']['account']);

        $function = $namespaces['integrations.weather']['functions'][0];
        self::assertSame('forecast', $function['name']);
        self::assertSame('postal_code', $function['parameters'][0]['name']);
        self::assertSame('read', $function['effect']);
        self::assertSame('object', $function['returns']['type']);
    }

    public function test_bridge_validates_named_arguments_before_dispatch(): void
    {
        $invoker = new RecordingScriptToolInvoker;
        $bridge = new ScriptBridge(
            ['integrations.weather.forecast' => 'weather_forecast'],
            ['integrations.weather.forecast' => [[
                'name' => 'units',
                'type' => 'string',
                'required' => true,
                'enum' => ['metric', 'imperial'],
            ]]],
            $invoker,
        );

        try {
            $bridge->call('integrations.weather.forecast', ['units' => 'kelvin', 'secret' => 'redacted']);
            self::fail('Invalid arguments should fail before dispatch.');
        } catch (ScriptBridgeException $exception) {
            self::assertSame('invalid_arguments', $exception->errorType);
            self::assertStringContainsString('wrong type: units', $exception->getMessage());
            self::assertStringContainsString('unknown: secret', $exception->getMessage());
            self::assertStringContainsString('No external call was made', $exception->getMessage());
        }

        self::assertSame([], $invoker->calls);
        self::assertSame('none', $bridge->getCallLog()[0]['effectStatus']);
    }

    public function test_bridge_maps_list_arguments_and_account_aliases(): void
    {
        $invoker = new RecordingScriptToolInvoker;
        $bridge = new ScriptBridge(
            ['integrations.records.work.create' => 'records_create'],
            ['integrations.records.work.create' => [[
                'name' => 'rows',
                'type' => 'array',
                'required' => true,
            ]]],
            $invoker,
            ['integrations.records.work.create' => 'work'],
        );

        $result = $bridge->call('integrations.records.work.create', [['id' => 'fake-1']]);

        self::assertSame(['ok' => true], $result);
        self::assertSame('work', $invoker->calls[0]['account']);
        self::assertSame([['id' => 'fake-1']], $invoker->calls[0]['args']['rows']);
    }

    public function test_bridge_marks_failed_writes_as_ambiguous_and_not_retryable(): void
    {
        $invoker = new RecordingScriptToolInvoker;
        $invoker->type = 'write';
        $invoker->failure = new \RuntimeException('Provider did not confirm completion.');
        $bridge = new ScriptBridge(
            ['integrations.records.create' => 'records_create'],
            ['integrations.records.create' => []],
            $invoker,
        );

        try {
            $bridge->call('integrations.records.create', []);
            self::fail('The fake provider failure should escape to the host.');
        } catch (\RuntimeException $exception) {
            self::assertSame('Provider did not confirm completion.', $exception->getMessage());
        }

        $entry = $bridge->getCallLog()[0];
        self::assertSame('write', $entry['effect']);
        self::assertSame('unknown', $entry['effectStatus']);
        self::assertFalse($entry['retryable']);
    }

    public function test_missing_null_and_custom_effect_metadata_are_conservative_writes(): void
    {
        foreach (['missing' => null, 'null' => null, 'custom' => 'side_effect'] as $case => $type) {
            $success = new RecordingScriptToolInvoker;
            $success->omitType = $case === 'missing';
            $success->type = $type;
            $bridge = new ScriptBridge(['integrations.safe.call' => 'safe_call'], [], $success);

            self::assertSame(['ok' => true], $bridge->call('integrations.safe.call'));
            $entry = $bridge->getCallLog()[0];
            self::assertSame('write', $entry['effect'], $case);
            self::assertSame('succeeded', $entry['effectStatus'], $case);
            self::assertFalse($entry['retryable'], $case);

            $failure = new RecordingScriptToolInvoker;
            $failure->omitType = $case === 'missing';
            $failure->type = $type;
            $failure->failure = new \RuntimeException('Unconfirmed fake effect.');
            $failedBridge = new ScriptBridge(['integrations.safe.call' => 'safe_call'], [], $failure);

            try {
                $failedBridge->call('integrations.safe.call');
                self::fail('The fake provider failure should escape to the host.');
            } catch (\RuntimeException $exception) {
                self::assertSame('Unconfirmed fake effect.', $exception->getMessage());
            }

            $entry = $failedBridge->getCallLog()[0];
            self::assertSame('write', $entry['effect'], $case);
            self::assertSame('unknown', $entry['effectStatus'], $case);
            self::assertFalse($entry['retryable'], $case);
        }
    }

    public function test_catalog_and_renderer_only_advertise_explicit_reads_as_read(): void
    {
        $builder = new ScriptCatalogBuilder;
        $renderer = new ScriptDocRenderer;

        foreach (['missing' => null, 'null' => null, 'custom' => 'side_effect', 'read' => 'read', 'write' => 'write'] as $case => $type) {
            $tool = ['slug' => 'fake_'.$case, 'name' => 'Fake '.$case, 'parameters' => []];
            if ($case !== 'missing') {
                $tool['type'] = $type;
            }
            $namespaces = $builder->buildNamespaces([['name' => 'fake', 'isIntegration' => true, 'tools' => [$tool]]]);
            $function = $namespaces['integrations.fake']['functions'][0];
            $effect = $function['effect'];
            self::assertSame($case === 'read' ? 'read' : 'write', $effect, $case);

            $docs = $renderer->generateFunctionDocs('integrations.fake', $function['name'], $namespaces);
            self::assertStringContainsString('**Effect:** `'.$effect.'`', $docs, $case);
        }
    }

    public function test_unknown_function_errors_include_ranked_repair_suggestions(): void
    {
        $bridge = new ScriptBridge(
            ['integrations.weather.forecast' => 'weather_forecast'],
            [],
            new RecordingScriptToolInvoker,
        );

        try {
            $bridge->call('integrations.weather.forcast');
            self::fail('An unknown path must not dispatch.');
        } catch (ScriptBridgeException $exception) {
            self::assertSame('unknown_function', $exception->errorType);
            self::assertSame(['integrations.weather.forecast'], $exception->details['suggestions']);
        }
    }

    public function test_renderer_exposes_effect_parameter_and_return_contracts(): void
    {
        $namespaces = [
            'integrations.weather' => [
                'description' => 'Weather data',
                'functions' => [[
                    'name' => 'forecast',
                    'description' => 'Read a forecast.',
                    'fullDescription' => '',
                    'parameters' => [[
                        'name' => 'units',
                        'type' => 'string',
                        'required' => false,
                        'enum' => ['metric', 'imperial'],
                    ]],
                    'sourceToolSlug' => 'weather_forecast',
                    'effect' => 'read',
                    'returns' => [
                        'type' => 'object',
                        'properties' => ['temperature' => ['type' => 'number']],
                    ],
                ]],
            ],
        ];

        $renderer = new ScriptDocRenderer;
        $docs = $renderer->generateFunctionDocs('integrations.weather', 'forecast', $namespaces);

        self::assertStringContainsString('**Effect:** `read`', $docs);
        self::assertStringContainsString('Values: `metric`, `imperial`', $docs);
        self::assertStringContainsString('**Returns:** `object` Keys: `temperature`.', $docs);
        self::assertStringContainsString('app.integrations.weather.forecast', $renderer->search('forecast', $namespaces));
    }
}

/**
 * Records bridge dispatches without requiring a real host or integration.
 */
final class RecordingScriptToolInvoker implements ScriptToolInvoker
{
    /** @var list<array{slug: string, args: array<string, mixed>, account: ?string}> */
    public array $calls = [];

    public mixed $type = 'read';

    public bool $omitType = false;

    public ?\Throwable $failure = null;

    /**
     * @param  array<string, mixed>  $args
     * @return array{ok: true}
     */
    public function invoke(string $toolSlug, array $args, ?string $account = null): mixed
    {
        $this->calls[] = ['slug' => $toolSlug, 'args' => $args, 'account' => $account];

        if ($this->failure !== null) {
            throw $this->failure;
        }

        return ['ok' => true];
    }

    /** @return array{icon: string, name: string, type?: mixed} */
    public function getToolMeta(string $toolSlug): array
    {
        $metadata = ['icon' => 'ph:test-tube', 'name' => $toolSlug];
        if (! $this->omitType) {
            $metadata['type'] = $this->type;
        }

        return $metadata;
    }
}

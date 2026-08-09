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
 * tenancy, authorization, provider I/O, or QuickJS itself.
 */
final class ScriptRuntimeTest extends TestCase
{
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

    public string $type = 'read';

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

    /** @return array{icon: string, name: string, type: string} */
    public function getToolMeta(string $toolSlug): array
    {
        return ['icon' => 'ph:test-tube', 'name' => $toolSlug, 'type' => $this->type];
    }
}

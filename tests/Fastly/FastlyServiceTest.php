<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Fastly;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Fastly\FastlyOperations;
use OpenCompany\Integrations\Fastly\FastlyService;
use OpenCompany\Integrations\Fastly\FastlyToolProvider;
use OpenCompany\Integrations\Fastly\Tools\FastlyKvStoreItemKvStoreUpsertItem;
use OpenCompany\Integrations\Fastly\Tools\FastlyRealtimeGetStatsLastSecond;
use OpenCompany\Integrations\Fastly\Tools\FastlyServiceCreateService;
use OpenCompany\Integrations\Fastly\Tools\FastlyServiceGetServiceDetail;
use OpenCompany\Integrations\Fastly\Tools\FastlyServiceListServices;
use PHPUnit\Framework\TestCase;

final class FastlyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_matches_generated_client_manifest_and_docs(): void
    {
        $provider = new FastlyToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/fastly/fastly-openapi-manifest.json'), true);

        self::assertSame('fastly', $provider->appName());
        self::assertSame('Fastly', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertStringContainsString('github.com/fastly/fastly-php', $provider->integrationMeta()['source_url']);
        self::assertSame(586, $manifest['method_count']);
        self::assertCount($manifest['method_count'], FastlyOperations::all());
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('api_key_header', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertArrayHasKey('fastly_service_list_services', $provider->tools());
        self::assertArrayHasKey('fastly_purge_purge_single_url', $provider->tools());
        self::assertArrayHasKey('fastly_realtime_get_stats_last_second', $provider->tools());
        self::assertArrayHasKey('fastly_kv_store_item_kv_store_upsert_item', $provider->tools());
    }

    public function test_service_maps_fastly_key_path_query_form_json_body_and_rt_host(): void
    {
        Http::fake([
            'https://api.example.test/service/svc%201/details*' => Http::response(['id' => 'svc 1'], 200),
            'https://api.example.test/service' => Http::response(['id' => 'created'], 200),
            'https://api.example.test/resources/stores/kv/store-1/keys/key-1*' => Http::response(['ok' => true], 200),
            'https://rt.example.test/v1/channel/svc-1/ts/1700000000' => Http::response(['Data' => ['status' => 200]], 200),
        ]);

        $service = new FastlyService('fastly-token', 'https://api.example.test', 'https://rt.example.test');

        self::assertSame(['id' => 'svc 1'], $service->executeOperation(FastlyOperations::all()['fastly_service_get_service_detail'], [
            'service_id' => 'svc 1',
            'version' => 3,
            'filter_versions_active' => true,
        ]));
        self::assertSame(['id' => 'created'], $service->executeOperation(FastlyOperations::all()['fastly_service_create_service'], [
            'name' => 'Example',
            'type' => 'vcl',
        ]));
        self::assertSame(['ok' => true], $service->executeOperation(FastlyOperations::all()['fastly_kv_store_item_kv_store_upsert_item'], [
            'store_id' => 'store-1',
            'key' => 'key-1',
            'if_generation_match' => 1,
            'add' => true,
            'body' => ['value' => 'abc'],
        ]));
        self::assertSame(['Data' => ['status' => 200]], $service->executeOperation(FastlyOperations::all()['fastly_realtime_get_stats_last_second'], [
            'service_id' => 'svc-1',
            'timestamp_in_seconds' => 1700000000,
        ]));

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://api.example.test/service/svc%201/details?')
                && ($query['version'] ?? null) === '3'
                && ($query['filter']['versions.active'] ?? null) === 'true'
                && $request->hasHeader('Fastly-Key', 'fastly-token');
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/service'
            && str_contains($request->body(), 'name=Example')
            && str_contains($request->body(), 'type=vcl'));
        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'PUT'
                && str_starts_with($request->url(), 'https://api.example.test/resources/stores/kv/store-1/keys/key-1?')
                && ($query['add'] ?? null) === 'true'
                && $request->hasHeader('if-generation-match', '1')
                && $request['value'] === 'abc';
        });
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rt.example.test/v1/channel/svc-1/ts/1700000000');
    }

    public function test_generated_tools_validate_and_map_arguments(): void
    {
        Http::fake([
            'https://api.example.test/service/svc-1/details*' => Http::response(['id' => 'svc-1'], 200),
            'https://rt.example.test/v1/channel/svc-1/ts/1700000000' => Http::response(['Data' => []], 200),
        ]);

        $service = new FastlyService('fastly-token', 'https://api.example.test', 'https://rt.example.test');

        $get = new FastlyServiceGetServiceDetail($service);
        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('service_id must be a non-empty parameter.', $missing->error);

        $success = $get->execute(['service_id' => 'svc-1', 'version' => 1]);
        self::assertTrue($success->succeeded());
        self::assertSame('svc-1', $success->data['id']);

        $rt = (new FastlyRealtimeGetStatsLastSecond($service))->execute([
            'service_id' => 'svc-1',
            'timestamp_in_seconds' => 1700000000,
        ]);
        self::assertTrue($rt->succeeded());
    }

    public function test_provider_connection_and_named_account_resolution(): void
    {
        Http::fake([
            'https://api.example.test/service' => Http::response([['id' => 'svc-1']], 200),
            'https://tenant-api.example.test/service*' => Http::response([['id' => 'tenant-svc']], 200),
        ]);

        $provider = new FastlyToolProvider;
        self::assertTrue($provider->testConnection([
            'api_token' => 'direct-token',
            'api_url' => 'https://api.example.test',
        ])['success']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'fastly' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'api_token' => 'tenant-token',
                    'api_url' => 'https://tenant-api.example.test',
                    'rt_url' => 'https://tenant-rt.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'fastly' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'fastly' ? ['work'] : [];
            }
        });

        $tool = $provider->createTool(FastlyServiceListServices::class, ['account' => 'work']);
        $result = $tool->execute(['per_page' => 10]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant-svc', $result->data[0]['id']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://tenant-api.example.test/service?')
            && $request->hasHeader('Fastly-Key', 'tenant-token'));
    }
}

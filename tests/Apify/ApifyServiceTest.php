<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Apify;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Apify\ApifyService;
use OpenCompany\Integrations\Apify\ApifyToolProvider;
use OpenCompany\Integrations\Apify\Tools\ApifyActRunsPost;
use OpenCompany\Integrations\Apify\Tools\ApifyActorRunGet;
use OpenCompany\Integrations\Apify\Tools\ApifyActsGet;
use OpenCompany\Integrations\Apify\Tools\ApifyDatasetItemsGet;
use OpenCompany\Integrations\Apify\Tools\ApifyKeyValueStoreRecordGet;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Apify official OpenAPI operation coverage.
 */
final class ApifyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ApifyService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ApifyService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_official_openapi_surface(): void
    {
        $provider = new ApifyToolProvider;
        $tools = $provider->tools();

        self::assertSame('apify', $provider->appName());
        self::assertSame('Apify', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.apify.com/api/openapi.json', $provider->integrationMeta()['source_url']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('api_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(223, $tools);
        self::assertArrayHasKey('apify_act_runs_post', $tools);
        self::assertArrayHasKey('apify_dataset_items_get', $tools);
        self::assertArrayHasKey('apify_key_value_store_record_get', $tools);
        self::assertArrayHasKey('apify_webhook_dispatches_get', $tools);
        self::assertArrayNotHasKey('apify_run_actor', $tools);
    }

    public function test_service_maps_path_query_body_auth_and_legacy_base_url(): void
    {
        $service = new ApifyService('token-123', 'https://api.example.test/v2');

        Http::fake(['*' => Http::response(['data' => ['id' => 'run_123']], 201)]);
        self::assertTrue((new ApifyActRunsPost($service))->execute([
            'actor_id' => 'apify/web-scraper',
            'wait_for_finish' => 60,
            'body' => [
                'startUrls' => [
                    ['url' => 'https://example.test'],
                ],
            ],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v2/acts/apify%2Fweb-scraper/runs?waitForFinish=60'
            && $request->hasHeader('Authorization', 'Bearer token-123')
            && $request['startUrls'][0]['url'] === 'https://example.test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['status' => 'SUCCEEDED']], 200)]);
        self::assertTrue((new ApifyActorRunGet($service))->execute([
            'run_id' => 'run_123',
            'wait_for_finish' => 5,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v2/actor-runs/run_123?waitForFinish=5');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['url' => 'https://example.test']], 200)]);
        self::assertTrue((new ApifyDatasetItemsGet($service))->execute([
            'dataset_id' => 'dataset_123',
            'format' => 'json',
            'clean' => true,
            'limit' => 100,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.example.test/v2/datasets/dataset_123/items?')
            && str_contains($request->url(), 'format=json')
            && str_contains($request->url(), 'clean=1')
            && str_contains($request->url(), 'limit=100'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('plain output', 200, ['Content-Type' => 'text/plain'])]);
        $record = (new ApifyKeyValueStoreRecordGet($service))->execute([
            'store_id' => 'store_123',
            'record_key' => 'OUTPUT',
        ]);
        self::assertTrue($record->succeeded());
        self::assertSame('plain output', $record->data['body']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v2/key-value-stores/store_123/records/OUTPUT');
    }

    public function test_validation_errors_test_connection_and_multi_account(): void
    {
        $service = new ApifyService('token-123', 'https://api.example.test');

        $missingPath = (new ApifyActorRunGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('run_id is required', (string) $missingPath->error);

        $missingBody = (new ApifyActRunsPost($service))->execute(['actor_id' => 'apify/web-scraper']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body is required', (string) $missingBody->error);

        $unconfigured = (new ApifyActsGet(new ApifyService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['error' => ['message' => 'Invalid token']], 401)]);
        $apiError = (new ApifyActsGet($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid token', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['username' => 'example-user']], 200)]);
        self::assertSame(
            ['success' => true, 'message' => 'Connected to Apify API as example-user.'],
            (new ApifyToolProvider)->testConnection([
                'api_token' => 'token-123',
                'url' => 'https://api.example.test/v2',
            ]),
        );
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/v2/users/me'
            && $request->hasHeader('Authorization', 'Bearer token-123'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['items' => []]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['apify', 'api_token', 'workspace'] => 'account-token',
                    ['apify', 'url', 'workspace'] => 'https://account-api.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'apify' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'apify' ? ['workspace'] : [];
            }
        });

        $tool = (new ApifyToolProvider)->createTool(ApifyActsGet::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute(['limit' => 5])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-api.example.test/v2/acts?limit=5'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}

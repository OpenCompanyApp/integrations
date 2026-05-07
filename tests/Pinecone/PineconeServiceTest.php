<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Pinecone;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Pinecone\PineconeService;
use OpenCompany\Integrations\Pinecone\PineconeToolProvider;
use OpenCompany\Integrations\Pinecone\Tools\PineconeFetchVectors;
use OpenCompany\Integrations\Pinecone\Tools\PineconeQueryVectors;
use OpenCompany\Integrations\Pinecone\Tools\PineconeUpdateVector;
use OpenCompany\Integrations\Pinecone\Tools\PineconeUpsertVectors;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Pinecone REST API mapping.
 */
final class PineconeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PineconeService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PineconeService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_uses_current_auth_metadata_and_expanded_tool_surface(): void
    {
        $provider = new PineconeToolProvider;

        self::assertSame('pinecone', $provider->appName());
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.pinecone.io/reference/api', $provider->integrationMeta()['source_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(12, $provider->tools());
        self::assertArrayHasKey('pinecone_configure_index', $provider->tools());
        self::assertArrayHasKey('pinecone_fetch_vectors', $provider->tools());
        self::assertArrayHasKey('pinecone_delete_vectors', $provider->tools());
        self::assertArrayNotHasKey('pinecone_get_current_user', $provider->tools());
    }

    public function test_requests_use_api_key_and_version_headers(): void
    {
        $service = new PineconeService('token-123', 'https://api.example.test', '2026-04');

        Http::fake(['*' => Http::response(['indexes' => []], 200)]);
        self::assertSame(['indexes' => []], $service->listIndexes());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.example.test/indexes'
            && $request->hasHeader('Api-Key', 'token-123')
            && $request->hasHeader('X-Pinecone-Api-Version', '2026-04')
            && !$request->hasHeader('Authorization'));
    }

    public function test_data_plane_tools_shape_official_paths_and_payloads(): void
    {
        $service = new PineconeService('token-123');
        $host = 'https://index.example.test';

        Http::fake(['*' => Http::response(['upsertedCount' => 1], 200)]);
        self::assertTrue((new PineconeUpsertVectors($service))->execute([
            'index_host' => $host,
            'namespace' => 'docs',
            'vectors' => [['id' => 'vec1', 'values' => [0.1, 0.2]]],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === $host . '/vectors/upsert'
            && $request['namespace'] === 'docs');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['matches' => []], 200)]);
        self::assertTrue((new PineconeQueryVectors($service))->execute([
            'index_host' => $host,
            'namespace' => 'docs',
            'vector' => [0.1, 0.2],
            'include_values' => true,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === $host . '/query'
            && $request['include_values'] === true
            && $request['namespace'] === 'docs');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['vectors' => []], 200)]);
        self::assertTrue((new PineconeFetchVectors($service))->execute([
            'index_host' => $host,
            'namespace' => 'docs',
            'ids' => ['vec1', 'vec2'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === $host . '/vectors/fetch?ids=vec1&ids=vec2&namespace=docs');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['matchedRecords' => 1], 200)]);
        self::assertTrue((new PineconeUpdateVector($service))->execute([
            'index_host' => $host,
            'id' => 'vec1',
            'set_metadata' => ['status' => 'reviewed'],
            'dry_run' => true,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === $host . '/vectors/update'
            && $request['setMetadata'] === ['status' => 'reviewed']
            && $request['dryRun'] === true);
    }

    public function test_multi_account_resolution_uses_account_api_key(): void
    {
        Http::fake(['*' => Http::response(['indexes' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['pinecone', 'api_key', 'workspace'] => 'account-token',
                    ['pinecone', 'url', 'workspace'] => 'https://account.example.test',
                    ['pinecone', 'api_version', 'workspace'] => '2026-04',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'pinecone' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'pinecone' ? ['workspace'] : [];
            }
        });

        $tool = (new PineconeToolProvider)->createTool(\OpenCompany\Integrations\Pinecone\Tools\PineconeListIndexes::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account.example.test/indexes'
            && $request->hasHeader('Api-Key', 'account-token'));
    }
}

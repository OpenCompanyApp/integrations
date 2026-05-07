<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Meilisearch;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Meilisearch\MeilisearchOperations;
use OpenCompany\Integrations\Meilisearch\MeilisearchService;
use OpenCompany\Integrations\Meilisearch\MeilisearchToolProvider;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchGetHealth;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchPutdistinctAttribute;
use OpenCompany\Integrations\Meilisearch\Tools\MeilisearchSearchDocuments;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Meilisearch official OpenAPI operation coverage.
 */
final class MeilisearchServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(MeilisearchService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(MeilisearchService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_official_openapi_surface(): void
    {
        $provider = new MeilisearchToolProvider;

        self::assertSame('meilisearch', $provider->appName());
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://github.com/meilisearch/meilisearch/releases/download/v1.43.0/meilisearch-openapi.json', $provider->integrationMeta()['source_url']);
        self::assertCount(138, MeilisearchOperations::all());
        self::assertCount(138, $provider->tools());
        self::assertArrayHasKey('meilisearch_list_indexes', $provider->tools());
        self::assertArrayHasKey('meilisearch_search_documents', $provider->tools());
        self::assertArrayHasKey('meilisearch_create_api_key', $provider->tools());
        self::assertArrayHasKey('meilisearch_get_network', $provider->tools());
        self::assertArrayHasKey('meilisearch_get_metrics', $provider->tools());
    }

    public function test_optional_auth_path_replacement_and_loose_body_arguments(): void
    {
        $service = new MeilisearchService('', 'https://search.example.test');

        Http::fake(['*' => Http::response(['status' => 'available'], 200)]);
        self::assertTrue((new MeilisearchGetHealth($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://search.example.test/health'
            && !$request->hasHeader('Authorization'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['hits' => [['id' => 1]]], 200)]);
        self::assertTrue((new MeilisearchSearchDocuments($service))->execute([
            'index_uid' => 'books',
            'q' => 'ranking',
            'limit' => 5,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://search.example.test/indexes/books/search'
            && $request['q'] === 'ranking'
            && $request['limit'] === 5);
    }

    public function test_bearer_auth_query_mapping_and_text_plain_body(): void
    {
        $service = new MeilisearchService('master-key', 'https://search.example.test');

        Http::fake(['*' => Http::response(['taskUid' => 7], 202)]);
        self::assertTrue((new MeilisearchPutdistinctAttribute($service))->execute([
            'index_uid' => 'books',
            'body' => 'isbn',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://search.example.test/indexes/books/settings/distinct-attribute'
            && $request->hasHeader('Authorization', 'Bearer master-key')
            && $request->body() === 'isbn');
    }

    public function test_multi_account_resolution_uses_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['status' => 'available'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['meilisearch', 'api_key', 'workspace'] => 'account-key',
                    ['meilisearch', 'url', 'workspace'] => 'https://account.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'meilisearch' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'meilisearch' ? ['workspace'] : [];
            }
        });

        $tool = (new MeilisearchToolProvider)->createTool(MeilisearchGetHealth::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account.example.test/health'
            && $request->hasHeader('Authorization', 'Bearer account-key'));
    }
}

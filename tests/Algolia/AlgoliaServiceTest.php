<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Algolia;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Algolia\AlgoliaService;
use OpenCompany\Integrations\Algolia\AlgoliaToolProvider;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaApiGet;
use OpenCompany\Integrations\Algolia\Tools\AlgoliaSetSettings;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Algolia Search API integration.
 */
final class AlgoliaServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AlgoliaService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AlgoliaService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_and_docs(): void
    {
        $provider = new AlgoliaToolProvider;

        self::assertSame('algolia', $provider->appName());
        self::assertSame('Algolia', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(39, $provider->tools());
        self::assertArrayHasKey('algolia_search_multiple', $provider->tools());
        self::assertArrayHasKey('algolia_set_settings', $provider->tools());
        self::assertArrayHasKey('algolia_batch_synonyms', $provider->tools());
        self::assertArrayHasKey('algolia_batch_rules', $provider->tools());
        self::assertArrayHasKey('algolia_list_logs', $provider->tools());
        self::assertArrayHasKey('algolia_api_delete', $provider->tools());
    }

    public function test_service_maps_search_index_synonym_rule_key_log_task_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AlgoliaService('APP123', 'key-test');
        $service->search('products', ['query' => 'phone']);
        $service->searchMultiple([['indexName' => 'products', 'params' => 'query=phone']]);
        $service->browse('products', ['cursor' => 'abc']);
        $service->searchFacetValues('products', 'brand', ['facetQuery' => 'sony']);
        $service->setSettings('products', ['searchableAttributes' => ['name']], ['forwardToReplicas' => true]);
        $service->deleteIndex('old_products');
        $service->indexOperation('products', 'copy', 'products_copy');
        $service->getTask('products', 123);
        $service->saveSynonym('products', 'syn-1', ['type' => 'synonym']);
        $service->batchSynonyms('products', [['objectID' => 'syn-2']], ['replaceExistingSynonyms' => false]);
        $service->saveRule('products', 'rule-1', ['condition' => ['pattern' => 'phone']]);
        $service->batchRules('products', [['objectID' => 'rule-2']], ['clearExistingRules' => false]);
        $service->addApiKey(['acl' => ['search']]);
        $service->updateApiKey('restricted-key', ['acl' => ['search', 'browse']]);
        $service->listLogs(['length' => 10, 'type' => 'all']);
        $service->apiGet('/indexes/products/settings', ['include' => ['one', 'two']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://app123-dsn.algolia.net/1/indexes/products/query'
            && $request->hasHeader('X-Algolia-Application-Id', 'APP123')
            && $request->hasHeader('X-Algolia-API-Key', 'key-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://app123-dsn.algolia.net/1/indexes/*/queries');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://app123-dsn.algolia.net/1/indexes/products/facets/brand/query'
            && $request['facetQuery'] === 'sony');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://app123.algolia.net/1/indexes/products/settings?forwardToReplicas=true'
            && $request['searchableAttributes'] === ['name']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://app123.algolia.net/1/indexes/products/synonyms/batch?replaceExistingSynonyms=false');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://app123.algolia.net/1/indexes/products/rules/batch?clearExistingRules=false');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://app123.algolia.net/1/keys/restricted-key'
            && $request['acl'] === ['search', 'browse']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://app123.algolia.net/1/logs?length=10&type=all');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://app123.algolia.net/1/indexes/products/settings?include=one&include=two');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/indexes');
    }

    public function test_tools_validate_arguments_and_unconfigured_service(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AlgoliaService('APP123', 'key-test');
        $settings = (new AlgoliaSetSettings($service))->execute([
            'indexName' => 'products',
            'settings' => ['searchableAttributes' => ['name']],
        ]);
        $raw = (new AlgoliaApiGet($service))->execute([
            'path' => '/indexes/products/settings',
        ]);

        self::assertTrue($settings->succeeded());
        self::assertTrue($raw->succeeded());

        $missing = (new AlgoliaSetSettings($service))->execute(['settings' => []]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('indexName is required', (string) $missing->error);

        $unconfigured = (new AlgoliaApiGet(new AlgoliaService('', '')))->execute([
            'path' => '/indexes',
        ]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_index_listing_endpoint(): void
    {
        Http::fake(['*' => Http::response(['items' => [['name' => 'products']]], 200)]);

        $result = (new AlgoliaToolProvider)->testConnection([
            'app_id' => 'APP123',
            'api_key' => 'key-test',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://app123.algolia.net/1/indexes'
            && $request->hasHeader('X-Algolia-Application-Id', 'APP123'));
    }
}

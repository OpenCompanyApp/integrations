<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Wikidata;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Wikidata\Tools\WikidataEntityDataUrl;
use OpenCompany\Integrations\Wikidata\Tools\WikidataEntityPageUrl;
use OpenCompany\Integrations\Wikidata\Tools\WikidataGetClaims;
use OpenCompany\Integrations\Wikidata\Tools\WikidataGetEntities;
use OpenCompany\Integrations\Wikidata\Tools\WikidataSearchEntities;
use OpenCompany\Integrations\Wikidata\Tools\WikidataSparql;
use OpenCompany\Integrations\Wikidata\WikidataService;
use OpenCompany\Integrations\Wikidata\WikidataToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Wikidata integration.
 */
final class WikidataServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(WikidataService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(WikidataService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new WikidataToolProvider;

        self::assertSame('wikidata', $provider->appName());
        self::assertSame('Wikidata', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'wikidata_search_entities',
            'wikidata_get_entities',
            'wikidata_get_claims',
            'wikidata_sparql',
            'wikidata_entity_data_url',
            'wikidata_entity_page_url',
        ], array_keys($provider->tools()));
    }

    public function test_action_api_tools_map_parameters_and_user_agent(): void
    {
        $service = new WikidataService(apiUrl: 'https://wd.example.test/w/api.php', sparqlUrl: 'https://query.example.test/sparql');

        Http::fake(['*' => Http::response(['search' => [['id' => 'Q42']]], 200)]);
        self::assertTrue((new WikidataSearchEntities($service))->execute(['search' => 'Douglas Adams', 'type' => 'item', 'limit' => 3])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://wd.example.test/w/api.php?')
            && $request->hasHeader('User-Agent')
            && str_contains($request->url(), 'action=wbsearchentities')
            && str_contains($request->url(), 'search=Douglas%20Adams')
            && str_contains($request->url(), 'language=en')
            && str_contains($request->url(), 'limit=3'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['entities' => ['Q42' => ['id' => 'Q42']]], 200)]);
        self::assertTrue((new WikidataGetEntities($service))->execute(['ids' => 'Q42|Q60', 'props' => 'labels|descriptions', 'languages' => 'en'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'action=wbgetentities')
            && str_contains($request->url(), 'ids=Q42%7CQ60')
            && str_contains($request->url(), 'props=labels%7Cdescriptions')
            && str_contains($request->url(), 'languages=en'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['claims' => ['P31' => []]], 200)]);
        self::assertTrue((new WikidataGetClaims($service))->execute(['entity' => 'Q42', 'property' => 'P31', 'rank' => 'normal'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'action=wbgetclaims')
            && str_contains($request->url(), 'entity=Q42')
            && str_contains($request->url(), 'property=P31')
            && str_contains($request->url(), 'rank=normal'));
    }

    public function test_sparql_urls_validation_errors_and_provider_creation(): void
    {
        $service = new WikidataService(
            apiUrl: 'https://wd.example.test/w/api.php',
            sparqlUrl: 'https://query.example.test/sparql',
            entityDataBaseUrl: 'https://wd.example.test/wiki/Special:EntityData',
            entityBaseUrl: 'https://wd.example.test/wiki',
        );

        Http::fake(['*' => Http::response(['head' => ['vars' => ['item']], 'results' => ['bindings' => []]], 200)]);
        self::assertTrue((new WikidataSparql($service))->execute(['query' => 'SELECT * WHERE { ?s ?p ?o } LIMIT 1', 'timeout' => 1000])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://query.example.test/sparql?')
            && str_contains($request->url(), 'format=json')
            && str_contains($request->url(), 'timeout=1000'));

        $dataUrl = (new WikidataEntityDataUrl($service))->execute(['id' => 'Q42', 'format' => 'ttl']);
        self::assertTrue($dataUrl->succeeded());
        self::assertSame('https://wd.example.test/wiki/Special:EntityData/Q42.ttl', $dataUrl->data['url']);

        $pageUrl = (new WikidataEntityPageUrl($service))->execute(['id' => 'https://www.wikidata.org/wiki/P31']);
        self::assertTrue($pageUrl->succeeded());
        self::assertSame('https://wd.example.test/wiki/P31', $pageUrl->data['url']);

        $badType = (new WikidataSearchEntities($service))->execute(['search' => 'x', 'type' => 'bad']);
        self::assertFalse($badType->succeeded());
        self::assertStringContainsString('type must be item or property', (string) $badType->error);

        $badId = (new WikidataEntityDataUrl($service))->execute(['id' => 'bad']);
        self::assertFalse($badId->succeeded());
        self::assertStringContainsString('Q or P identifier', (string) $badId->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['error' => ['info' => 'bad request']], 200)]);
        $apiError = (new WikidataGetClaims($service))->execute(['entity' => 'Q42']);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('bad request', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['entities' => ['Q42' => []]], 200)]);
        app()->instance(WikidataService::class, new WikidataService(apiUrl: 'https://wd.example.test/w/api.php'));
        $tool = (new WikidataToolProvider)->createTool(WikidataGetEntities::class);
        self::assertTrue($tool->execute(['ids' => 'Q42'])->succeeded());
    }
}

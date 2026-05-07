<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenStreetMap;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\OpenStreetMap\OpenStreetMapService;
use OpenCompany\Integrations\OpenStreetMap\OpenStreetMapToolProvider;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapMapUrl;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimDetails;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimLookup;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimReverse;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimSearch;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapObjectUrl;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapOverpassQuery;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the OpenStreetMap integration.
 */
final class OpenStreetMapServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenStreetMapService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenStreetMapService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new OpenStreetMapToolProvider;

        self::assertSame('openstreetmap', $provider->appName());
        self::assertSame('OpenStreetMap', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(9, $provider->tools());
        self::assertSame([], $provider->credentialFields());
        self::assertSame([], $provider->configSchema());
    }

    public function test_nominatim_search_reverse_lookup_and_details_paths_are_mapped(): void
    {
        $service = new OpenStreetMapService(
            nominatimUrl: 'https://nominatim.example.test',
            overpassUrl: 'https://overpass.example.test/api',
            osmBaseUrl: 'https://osm.example.test',
        );

        Http::fake(['*' => Http::response([['place_id' => 1, 'display_name' => 'Berlin']], 200)]);
        self::assertTrue((new OpenStreetMapNominatimSearch($service))->execute(['q' => 'Berlin', 'limit' => 3, 'addressdetails' => true, 'extratags' => true])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://nominatim.example.test/search?')
            && $request->hasHeader('User-Agent')
            && str_contains($request->url(), 'q=Berlin')
            && str_contains($request->url(), 'limit=3')
            && str_contains($request->url(), 'addressdetails=1')
            && str_contains($request->url(), 'extratags=1')
            && str_contains($request->url(), 'format=jsonv2'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['place_id' => 2, 'display_name' => 'Gate'], 200)]);
        self::assertTrue((new OpenStreetMapNominatimReverse($service))->execute(['lat' => 52.5, 'lon' => 13.4, 'zoom' => 18])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://nominatim.example.test/reverse?')
            && str_contains($request->url(), 'lat=52.5')
            && str_contains($request->url(), 'lon=13.4')
            && str_contains($request->url(), 'zoom=18'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['place_id' => 3]], 200)]);
        self::assertTrue((new OpenStreetMapNominatimLookup($service))->execute(['osm_ids' => 'N123,W456,R789', 'namedetails' => true])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://nominatim.example.test/lookup?')
            && str_contains($request->url(), 'osm_ids=N123%2CW456%2CR789')
            && str_contains($request->url(), 'namedetails=1'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['place_id' => 3, 'names' => []], 200)]);
        self::assertTrue((new OpenStreetMapNominatimDetails($service))->execute(['osmtype' => 'N', 'osmid' => 123, 'hierarchy' => true])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://nominatim.example.test/details?')
            && str_contains($request->url(), 'osmtype=N')
            && str_contains($request->url(), 'osmid=123')
            && str_contains($request->url(), 'hierarchy=1'));
    }

    public function test_overpass_post_get_url_helpers_and_validation(): void
    {
        $service = new OpenStreetMapService(
            nominatimUrl: 'https://nominatim.example.test',
            overpassUrl: 'https://overpass.example.test/api',
            osmBaseUrl: 'https://osm.example.test',
        );

        Http::fake(['*' => Http::response(['elements' => [['type' => 'node', 'id' => 1]]], 200)]);
        self::assertTrue((new OpenStreetMapOverpassQuery($service))->execute(['query' => '[out:json];node(1);out;'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://overpass.example.test/api/interpreter'
            && ($request->data()['data'] ?? null) === '[out:json];node(1);out;');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['elements' => []], 200)]);
        self::assertTrue((new OpenStreetMapOverpassQuery($service))->execute(['query' => '[out:json];out;', 'method' => 'get'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://overpass.example.test/api/interpreter?')
            && str_contains($request->url(), 'data=%5Bout%3Ajson%5D%3Bout%3B'));

        $objectUrl = (new OpenStreetMapObjectUrl($service))->execute(['type' => 'way', 'id' => '12345']);
        self::assertTrue($objectUrl->succeeded());
        self::assertSame('https://osm.example.test/way/12345', $objectUrl->data['url']);

        $mapUrl = (new OpenStreetMapMapUrl($service))->execute(['lat' => 52.5, 'lon' => 13.4, 'zoom' => 12]);
        self::assertTrue($mapUrl->succeeded());
        self::assertStringContainsString('#map=12/52.5/13.4', $mapUrl->data['url']);

        $missingSearch = (new OpenStreetMapNominatimSearch($service))->execute([]);
        self::assertFalse($missingSearch->succeeded());
        self::assertStringContainsString('q or at least one structured address field is required', (string) $missingSearch->error);

        $missingDetails = (new OpenStreetMapNominatimDetails($service))->execute(['osmtype' => 'N']);
        self::assertFalse($missingDetails->succeeded());
        self::assertStringContainsString('place_id or both osmtype and osmid are required', (string) $missingDetails->error);

        $badObject = (new OpenStreetMapObjectUrl($service))->execute(['type' => 'area', 'id' => '123']);
        self::assertFalse($badObject->succeeded());
        self::assertStringContainsString('type must be node, way, or relation', (string) $badObject->error);
    }

    public function test_api_errors_and_provider_create_tool(): void
    {
        $service = new OpenStreetMapService(nominatimUrl: 'https://nominatim.example.test');

        Http::fake(['*' => Http::response(['error' => 'Rate limited'], 429)]);
        $apiError = (new OpenStreetMapNominatimReverse($service))->execute(['lat' => 1, 'lon' => 2]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Nominatim error (429): Rate limited', (string) $apiError->error);

        app()->instance(OpenStreetMapService::class, new OpenStreetMapService(nominatimUrl: 'https://nominatim.example.test'));
        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['place_id' => 1]], 200)]);
        $tool = (new OpenStreetMapToolProvider)->createTool(OpenStreetMapNominatimSearch::class);
        self::assertTrue($tool->execute(['q' => 'Berlin'])->succeeded());
    }
}

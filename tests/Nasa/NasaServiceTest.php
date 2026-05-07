<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Nasa;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Nasa\NasaService;
use OpenCompany\Integrations\Nasa\NasaToolProvider;
use OpenCompany\Integrations\Nasa\Tools\NasaGetEpicImages;
use OpenCompany\Integrations\Nasa\Tools\NasaSearchImages;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for NASA endpoint mapping and provider discovery.
 */
final class NasaServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_api_nasa_endpoints_send_api_key_to_documented_paths(): void
    {
        Http::fake([
            'https://api.nasa.test/planetary/apod*' => Http::response(['title' => 'APOD'], 200),
            'https://api.nasa.test/neo/rest/v1/neo/browse*' => Http::response(['near_earth_objects' => []], 200),
            'https://api.nasa.test/DONKI/CME*' => Http::response([['activityID' => 'CME-test']], 200),
            'https://api.nasa.test/EPIC/api/natural/images*' => Http::response([['image' => 'epic-test']], 200),
            'https://api.nasa.test/EPIC/api/enhanced/date/2026-01-01*' => Http::response([['image' => 'epic-date']], 200),
            'https://api.nasa.test/EPIC/api/natural/all*' => Http::response([['date' => '2026-01-01']], 200),
            'https://api.nasa.test/planetary/earth/imagery*' => Http::response(['url' => 'https://example.test/image.png'], 200),
            'https://api.nasa.test/planetary/earth/assets*' => Http::response(['results' => []], 200),
        ]);

        $service = new NasaService('key-test', 'https://api.nasa.test', 'https://images-api.nasa.test', 'https://eonet.test/api/v3');
        $service->getApod(date: '2026-01-01', count: 1, thumbs: true);
        $service->browseAsteroids(page: 1, size: 10);
        $service->getDonkiEvents('CME', ['startDate' => '2026-01-01']);
        $service->getEpicImages('natural');
        $service->getEpicImages('enhanced', '2026-01-01');
        $service->getEpicImages('natural', allDates: true);
        $service->getEarthImagery(['lon' => -122.4, 'lat' => 37.7, 'date' => '2026-01-01']);
        $service->getEarthAssets(['lon' => -122.4, 'lat' => 37.7]);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.nasa.test/planetary/apod?') && str_contains($request->url(), 'date=2026-01-01') && str_contains($request->url(), 'count=1') && str_contains($request->url(), 'thumbs=true') && str_contains($request->url(), 'api_key=key-test'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.nasa.test/neo/rest/v1/neo/browse?') && str_contains($request->url(), 'api_key=key-test'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.nasa.test/DONKI/CME?') && str_contains($request->url(), 'startDate=2026-01-01'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.nasa.test/EPIC/api/natural/images?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.nasa.test/EPIC/api/enhanced/date/2026-01-01?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.nasa.test/EPIC/api/natural/all?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.nasa.test/planetary/earth/imagery?') && str_contains($request->url(), 'lon=-122.4'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.nasa.test/planetary/earth/assets?') && str_contains($request->url(), 'lat=37.7'));
    }

    public function test_image_library_and_eonet_use_public_hosts_without_api_key(): void
    {
        Http::fake([
            'https://images-api.nasa.test/search*' => Http::response(['collection' => ['items' => []]], 200),
            'https://images-api.nasa.test/asset/NASA-ID*' => Http::response(['collection' => ['items' => []]], 200),
            'https://images-api.nasa.test/metadata/NASA-ID*' => Http::response(['location' => 'https://example.test/metadata.json'], 200),
            'https://images-api.nasa.test/captions/NASA-ID*' => Http::response(['location' => 'https://example.test/captions.srt'], 200),
            'https://eonet.test/api/v3/events*' => Http::response(['events' => []], 200),
            'https://eonet.test/api/v3/events/EONET-1*' => Http::response(['id' => 'EONET-1'], 200),
            'https://eonet.test/api/v3/categories*' => Http::response(['categories' => []], 200),
            'https://eonet.test/api/v3/sources*' => Http::response(['sources' => []], 200),
        ]);

        $service = new NasaService('key-test', 'https://api.nasa.test', 'https://images-api.nasa.test', 'https://eonet.test/api/v3');
        $service->searchImages('apollo', 'image', 2, ['center' => 'JSC']);
        $service->getImageAsset('NASA-ID');
        $service->getImageMetadata('NASA-ID');
        $service->getImageCaptions('NASA-ID');
        $service->getEonetEvents(['status' => 'open', 'limit' => 10]);
        $service->getEonetEvent('EONET-1');
        $service->getEonetCategories();
        $service->getEonetSources();

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://images-api.nasa.test/search?') && str_contains($request->url(), 'q=apollo') && ! str_contains($request->url(), 'api_key='));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://images-api.nasa.test/asset/NASA-ID' && ! str_contains($request->url(), 'api_key='));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://images-api.nasa.test/metadata/NASA-ID');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://images-api.nasa.test/captions/NASA-ID');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://eonet.test/api/v3/events?') && ! str_contains($request->url(), 'api_key='));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eonet.test/api/v3/events/EONET-1');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eonet.test/api/v3/categories');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://eonet.test/api/v3/sources');
    }

    public function test_tools_and_provider_expose_expanded_nasa_surface(): void
    {
        Http::fake([
            'https://api.nasa.test/EPIC/api/natural/images*' => Http::response([], 200),
            'https://images-api.nasa.test/search*' => Http::response(['collection' => ['items' => []]], 200),
        ]);

        $service = new NasaService('key-test', 'https://api.nasa.test', 'https://images-api.nasa.test', 'https://eonet.test/api/v3');
        $epic = (new NasaGetEpicImages($service))->execute(['collection' => 'natural']);
        $search = (new NasaSearchImages($service))->execute(['q' => 'apollo', 'media_type' => 'image']);

        self::assertNull($epic->error);
        self::assertNull($search->error);

        $provider = new NasaToolProvider();
        $tools = $provider->tools();
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertArrayNotHasKey('nasa_get_current_user', $tools);
        self::assertArrayHasKey('nasa_get_donki_events', $tools);
        self::assertArrayHasKey('nasa_get_eonet_sources', $tools);
        self::assertSame(17, count($tools));
    }
}

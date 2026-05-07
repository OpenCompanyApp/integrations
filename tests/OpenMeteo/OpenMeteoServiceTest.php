<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenMeteo;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\OpenMeteo\OpenMeteoService;
use OpenCompany\Integrations\OpenMeteo\OpenMeteoToolProvider;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoAirQuality;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoClimate;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoForecast;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoGeocodingGet;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoGeocodingSearch;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoModelForecast;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the public Open-Meteo API integration.
 */
final class OpenMeteoServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenMeteoService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenMeteoService::class);
        parent::tearDown();
    }

    public function test_provider_exposes_public_api_surface_and_docs(): void
    {
        $provider = new OpenMeteoToolProvider;

        self::assertSame('open-meteo', $provider->appName());
        self::assertSame('Open-Meteo', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());

        $tools = array_keys($provider->tools());
        self::assertCount(14, $tools);
        self::assertContains('open_meteo_forecast', $tools);
        self::assertContains('open_meteo_model_forecast', $tools);
        self::assertContains('open_meteo_historical_weather', $tools);
        self::assertContains('open_meteo_historical_forecast', $tools);
        self::assertContains('open_meteo_ensemble', $tools);
        self::assertContains('open_meteo_seasonal_forecast', $tools);
        self::assertContains('open_meteo_climate', $tools);
        self::assertContains('open_meteo_marine', $tools);
        self::assertContains('open_meteo_air_quality', $tools);
        self::assertContains('open_meteo_satellite_radiation', $tools);
        self::assertContains('open_meteo_flood', $tools);
        self::assertContains('open_meteo_elevation', $tools);
        self::assertContains('open_meteo_geocoding_search', $tools);
        self::assertContains('open_meteo_geocoding_get', $tools);
    }

    public function test_service_maps_all_endpoint_hosts_arrays_model_endpoint_and_optional_api_key(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new OpenMeteoService('customer-key');
        $service->get('forecast', ['latitude' => 52.52, 'longitude' => 13.41, 'hourly' => ['temperature_2m', 'precipitation'], 'timezone' => 'Europe/Berlin']);
        $service->get('model_forecast', ['model_endpoint' => 'gfs', 'latitude' => 52.52, 'longitude' => 13.41, 'hourly' => 'temperature_2m']);
        $service->get('archive', ['latitude' => 52.52, 'longitude' => 13.41, 'start_date' => '2024-01-01', 'end_date' => '2024-01-02']);
        $service->get('historical_forecast', ['latitude' => 52.52, 'longitude' => 13.41, 'start_date' => '2024-01-01', 'end_date' => '2024-01-02']);
        $service->get('ensemble', ['latitude' => 52.52, 'longitude' => 13.41]);
        $service->get('seasonal', ['latitude' => 52.52, 'longitude' => 13.41]);
        $service->get('climate', ['latitude' => 52.52, 'longitude' => 13.41, 'start_date' => '2050-01-01', 'end_date' => '2050-01-02', 'models' => ['CMCC_CM2_VHR4'], 'daily' => ['temperature_2m_mean']]);
        $service->get('marine', ['latitude' => 52.52, 'longitude' => 13.41]);
        $service->get('air_quality', ['latitude' => 52.52, 'longitude' => 13.41, 'hourly' => ['pm10', 'pm2_5']]);
        $service->get('satellite_radiation', ['latitude' => 52.52, 'longitude' => 13.41]);
        $service->get('flood', ['latitude' => 52.52, 'longitude' => 13.41]);
        $service->get('elevation', ['latitude' => [52.52, 48.85], 'longitude' => [13.41, 2.35]]);
        $service->get('geocoding_search', ['name' => 'Berlin', 'count' => 5]);
        $service->get('geocoding_get', ['id' => 2950159]);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.open-meteo.com/v1/forecast?')
            && str_contains($request->url(), 'hourly=temperature_2m%2Cprecipitation')
            && str_contains($request->url(), 'apikey=customer-key'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.open-meteo.com/v1/gfs?')
            && !str_contains($request->url(), 'model_endpoint='));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://archive-api.open-meteo.com/v1/archive?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://historical-forecast-api.open-meteo.com/v1/forecast?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://ensemble-api.open-meteo.com/v1/ensemble?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://seasonal-api.open-meteo.com/v1/seasonal?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://climate-api.open-meteo.com/v1/climate?')
            && str_contains($request->url(), 'models=CMCC_CM2_VHR4'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://marine-api.open-meteo.com/v1/marine?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://air-quality-api.open-meteo.com/v1/air-quality?')
            && str_contains($request->url(), 'hourly=pm10%2Cpm2_5'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://satellite-api.open-meteo.com/v1/satellite-radiation?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://flood-api.open-meteo.com/v1/flood?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.open-meteo.com/v1/elevation?')
            && str_contains($request->url(), 'latitude=52.52%2C48.85'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://geocoding-api.open-meteo.com/v1/search?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://geocoding-api.open-meteo.com/v1/get?'));
    }

    public function test_tools_validate_required_arguments_merge_query_and_convert_api_errors(): void
    {
        Http::fake(['*' => Http::response(['latitude' => 52.52], 200)]);
        $service = new OpenMeteoService();

        $forecast = (new OpenMeteoForecast($service))->execute([
            'latitude' => 52.52,
            'longitude' => 13.41,
            'query' => ['timezone' => 'UTC', 'forecast_days' => 3],
            'timezone' => 'Europe/Berlin',
        ]);
        self::assertTrue($forecast->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'timezone=Europe%2FBerlin') && str_contains($request->url(), 'forecast_days=3'));

        $missing = (new OpenMeteoClimate($service))->execute(['latitude' => 52.52, 'longitude' => 13.41]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('start_date is required', (string) $missing->error);

        $missingModel = (new OpenMeteoModelForecast($service))->execute(['latitude' => 52.52, 'longitude' => 13.41]);
        self::assertFalse($missingModel->succeeded());
        self::assertStringContainsString('model_endpoint is required', (string) $missingModel->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['error' => true, 'reason' => 'Bad latitude'], 400)]);
        $bad = (new OpenMeteoAirQuality($service))->execute(['latitude' => 999, 'longitude' => 13.41]);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('Bad latitude', (string) $bad->error);
    }

    public function test_geocoding_tools_and_provider_create_tool_use_bound_service(): void
    {
        Http::fake(['*' => Http::response(['results' => [['id' => 2950159, 'name' => 'Berlin']]], 200)]);

        $service = new OpenMeteoService();
        app()->instance(OpenMeteoService::class, $service);
        $provider = new OpenMeteoToolProvider;

        $search = (new OpenMeteoGeocodingSearch($service))->execute(['name' => 'Berlin', 'count' => 5, 'language' => 'en']);
        self::assertTrue($search->succeeded());

        $get = (new OpenMeteoGeocodingGet($service))->execute(['id' => 2950159, 'language' => 'de']);
        self::assertTrue($get->succeeded());

        $tool = $provider->createTool(OpenMeteoForecast::class);
        $created = $tool->execute(['latitude' => 52.52, 'longitude' => 13.41]);
        self::assertTrue($created->succeeded());

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://geocoding-api.open-meteo.com/v1/search?')
            && str_contains($request->url(), 'name=Berlin'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://geocoding-api.open-meteo.com/v1/get?')
            && str_contains($request->url(), 'id=2950159'));
    }
}

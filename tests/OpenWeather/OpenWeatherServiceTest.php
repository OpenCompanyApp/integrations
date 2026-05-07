<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenWeather;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\OpenWeather\OpenWeatherService;
use OpenCompany\Integrations\OpenWeather\OpenWeatherToolProvider;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherAirPollutionHistory;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherCurrentWeather;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherForecast5Day;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherGeocodingDirect;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherGeocodingReverse;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherOneCall;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherOneCallDaySummary;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the OpenWeather API integration.
 */
final class OpenWeatherServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenWeatherService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(OpenWeatherService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new OpenWeatherToolProvider;

        self::assertSame('openweather', $provider->appName());
        self::assertSame('OpenWeather', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame($provider->configSchema(), $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());

        self::assertSame([
            'openweather_current_weather',
            'openweather_forecast_5_day',
            'openweather_one_call',
            'openweather_one_call_timemachine',
            'openweather_one_call_day_summary',
            'openweather_one_call_overview',
            'openweather_air_pollution',
            'openweather_air_pollution_forecast',
            'openweather_air_pollution_history',
            'openweather_geocoding_direct',
            'openweather_geocoding_reverse',
            'openweather_geocoding_zip',
        ], array_keys($provider->tools()));
    }

    public function test_service_maps_official_weather_air_pollution_and_geocoding_endpoints(): void
    {
        Http::fake(['*' => Http::response(['cod' => 200, 'ok' => true], 200)]);

        $service = new OpenWeatherService('key-test');
        $service->get('current_weather', ['lat' => 52.52, 'lon' => 13.41, 'units' => 'metric']);
        $service->get('forecast_5_day', ['q' => 'Berlin,DE', 'cnt' => 3]);
        $service->get('one_call', ['lat' => 52.52, 'lon' => 13.41, 'exclude' => ['current', 'minutely']]);
        $service->get('one_call_timemachine', ['lat' => 52.52, 'lon' => 13.41, 'dt' => 1704067200]);
        $service->get('one_call_day_summary', ['lat' => 52.52, 'lon' => 13.41, 'date' => '2024-01-01']);
        $service->get('one_call_overview', ['lat' => 52.52, 'lon' => 13.41]);
        $service->get('air_pollution', ['lat' => 52.52, 'lon' => 13.41]);
        $service->get('air_pollution_forecast', ['lat' => 52.52, 'lon' => 13.41]);
        $service->get('air_pollution_history', ['lat' => 52.52, 'lon' => 13.41, 'start' => 1704067200, 'end' => 1704153600]);
        $service->get('geocoding_direct', ['q' => 'Berlin,DE', 'limit' => 1]);
        $service->get('geocoding_reverse', ['lat' => 52.52, 'lon' => 13.41, 'limit' => 2]);
        $service->get('geocoding_zip', ['zip' => '90210,US']);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/2.5/weather?')
            && str_contains($request->url(), 'units=metric')
            && str_contains($request->url(), 'appid=key-test'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/2.5/forecast?')
            && str_contains($request->url(), 'q=Berlin%2CDE'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/3.0/onecall?')
            && str_contains($request->url(), 'exclude=current%2Cminutely'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/3.0/onecall/timemachine?')
            && str_contains($request->url(), 'dt=1704067200'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/3.0/onecall/day_summary?')
            && str_contains($request->url(), 'date=2024-01-01'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/3.0/onecall/overview?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/2.5/air_pollution?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/2.5/air_pollution/forecast?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/data/2.5/air_pollution/history?')
            && str_contains($request->url(), 'start=1704067200')
            && str_contains($request->url(), 'end=1704153600'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/geo/1.0/direct?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/geo/1.0/reverse?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/geo/1.0/zip?')
            && str_contains($request->url(), 'zip=90210%2CUS'));
    }

    public function test_tools_validate_required_arguments_merge_query_and_convert_api_errors(): void
    {
        Http::fake(['*' => Http::response(['cod' => '200', 'name' => 'Berlin'], 200)]);
        $service = new OpenWeatherService('key-test');

        $current = (new OpenWeatherCurrentWeather($service))->execute([
            'lat' => 52.52,
            'lon' => 13.41,
            'query' => ['units' => 'imperial', 'lang' => 'en'],
            'units' => 'metric',
        ]);
        self::assertTrue($current->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'units=metric') && str_contains($request->url(), 'lang=en'));

        $missingLocation = (new OpenWeatherForecast5Day($service))->execute([]);
        self::assertFalse($missingLocation->succeeded());
        self::assertStringContainsString('Provide latitude and longitude', (string) $missingLocation->error);

        $missingDate = (new OpenWeatherOneCallDaySummary($service))->execute(['lat' => 52.52, 'lon' => 13.41]);
        self::assertFalse($missingDate->succeeded());
        self::assertStringContainsString('date is required', (string) $missingDate->error);

        $missingEnd = (new OpenWeatherAirPollutionHistory($service))->execute(['lat' => 52.52, 'lon' => 13.41, 'start' => 1704067200]);
        self::assertFalse($missingEnd->succeeded());
        self::assertStringContainsString('end is required', (string) $missingEnd->error);

        $unconfigured = (new OpenWeatherGeocodingDirect(new OpenWeatherService()))->execute(['q' => 'Berlin,DE']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('API key is not configured', (string) $unconfigured->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['cod' => 401, 'message' => 'Invalid API key'], 200)]);
        $bad = (new OpenWeatherOneCall($service))->execute(['lat' => 52.52, 'lon' => 13.41]);
        self::assertFalse($bad->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $bad->error);
    }

    public function test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response([['name' => 'London', 'lat' => 51.51]], 200)]);

        $provider = new OpenWeatherToolProvider;
        $ok = $provider->testConnection(['api_key' => 'key-test']);

        self::assertTrue($ok['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.openweathermap.org/geo/1.0/direct?')
            && str_contains($request->url(), 'q=London%2CGB')
            && str_contains($request->url(), 'appid=key-test'));

        $missingKey = $provider->testConnection([]);
        self::assertFalse($missingKey['success']);
        self::assertStringContainsString('No API key', (string) $missingKey['error']);

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return [$integration, $key, $account] === ['openweather', 'api_key', 'acct_1'] ? 'key-account' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'openweather' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'openweather' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(OpenWeatherGeocodingReverse::class, ['account' => 'acct_1']);
        $result = $tool->execute(['lat' => 52.52, 'lon' => 13.41]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.openweathermap.org/geo/1.0/reverse?')
            && str_contains($request->url(), 'appid=key-account'));
    }
}

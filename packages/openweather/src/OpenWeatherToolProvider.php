<?php

namespace OpenCompany\Integrations\OpenWeather;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherAirPollution;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherAirPollutionForecast;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherAirPollutionHistory;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherCurrentWeather;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherForecast5Day;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherGeocodingDirect;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherGeocodingReverse;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherGeocodingZip;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherOneCall;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherOneCallDaySummary;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherOneCallOverview;
use OpenCompany\Integrations\OpenWeather\Tools\OpenWeatherOneCallTimemachine;

/**
 * Tool catalog and configuration metadata for OpenWeather.
 *
 * Exposes core official OpenWeather API surfaces for weather, One Call 3.0,
 * air pollution, and geocoding.
 */
class OpenWeatherToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Requires an OpenWeather API key. Some One Call 3.0 endpoints may require the account to have the One Call subscription enabled.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'openweather';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'OpenWeather',
            'description' => 'Weather, forecasts, One Call 3.0, air pollution, and geocoding',
            'icon' => 'ph:cloud-sun',
            'logo' => 'simple-icons:openweather',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'OpenWeather',
            'description' => 'OpenWeather current weather, 5 day forecast, One Call 3.0, air pollution, and geocoding APIs.',
            'icon' => 'ph:cloud-sun',
            'logo' => 'simple-icons:openweather',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://openweathermap.org/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'OpenWeather API key', 'hint' => 'Required for all OpenWeather API calls.', 'required' => true],
        ];
    }

    /**
     * Verify OpenWeather credentials with a lightweight geocoding request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::acceptJson()->timeout(20)->get('https://api.openweathermap.org/geo/1.0/direct', [
                'q' => 'London,GB',
                'limit' => 1,
                'appid' => $apiKey,
            ]);

            return $response->successful()
                ? ['success' => true, 'message' => 'OpenWeather credentials verified.']
                : ['success' => false, 'error' => 'OpenWeather API returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function tools(): array
    {
        return [
            'openweather_current_weather' => ['class' => OpenWeatherCurrentWeather::class, 'type' => 'read', 'name' => 'Current Weather', 'description' => 'Get current weather data.', 'icon' => 'ph:cloud-sun'],
            'openweather_forecast_5_day' => ['class' => OpenWeatherForecast5Day::class, 'type' => 'read', 'name' => '5 Day Forecast', 'description' => 'Get 5 day / 3 hour forecast data.', 'icon' => 'ph:calendar'],
            'openweather_one_call' => ['class' => OpenWeatherOneCall::class, 'type' => 'read', 'name' => 'One Call', 'description' => 'Get One Call API 3.0 current weather, forecasts, and alerts.', 'icon' => 'ph:cloud-sun'],
            'openweather_one_call_timemachine' => ['class' => OpenWeatherOneCallTimemachine::class, 'type' => 'read', 'name' => 'One Call Timemachine', 'description' => 'Get One Call API 3.0 data for a timestamp.', 'icon' => 'ph:clock-counter-clockwise'],
            'openweather_one_call_day_summary' => ['class' => OpenWeatherOneCallDaySummary::class, 'type' => 'read', 'name' => 'One Call Day Summary', 'description' => 'Get daily aggregated weather data.', 'icon' => 'ph:calendar-check'],
            'openweather_one_call_overview' => ['class' => OpenWeatherOneCallOverview::class, 'type' => 'read', 'name' => 'One Call Overview', 'description' => 'Get human-readable weather overview output.', 'icon' => 'ph:text-align-left'],
            'openweather_air_pollution' => ['class' => OpenWeatherAirPollution::class, 'type' => 'read', 'name' => 'Air Pollution', 'description' => 'Get current air pollution data.', 'icon' => 'ph:wind'],
            'openweather_air_pollution_forecast' => ['class' => OpenWeatherAirPollutionForecast::class, 'type' => 'read', 'name' => 'Air Pollution Forecast', 'description' => 'Get forecasted air pollution data.', 'icon' => 'ph:wind'],
            'openweather_air_pollution_history' => ['class' => OpenWeatherAirPollutionHistory::class, 'type' => 'read', 'name' => 'Air Pollution History', 'description' => 'Get historical air pollution data.', 'icon' => 'ph:clock-counter-clockwise'],
            'openweather_geocoding_direct' => ['class' => OpenWeatherGeocodingDirect::class, 'type' => 'read', 'name' => 'Direct Geocoding', 'description' => 'Convert a location name into coordinates.', 'icon' => 'ph:magnifying-glass'],
            'openweather_geocoding_reverse' => ['class' => OpenWeatherGeocodingReverse::class, 'type' => 'read', 'name' => 'Reverse Geocoding', 'description' => 'Convert coordinates into location names.', 'icon' => 'ph:map-pin'],
            'openweather_geocoding_zip' => ['class' => OpenWeatherGeocodingZip::class, 'type' => 'read', 'name' => 'Zip Geocoding', 'description' => 'Convert a zip or post code into coordinates.', 'icon' => 'ph:map-pin'],
        ];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'OpenWeather API key', 'hint' => 'Required for all OpenWeather API calls.', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an OpenWeather tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): OpenWeatherService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new OpenWeatherService(apiKey: $creds->get('openweather', 'api_key', '', $account));
        }

        return app(OpenWeatherService::class);
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/openweather.md';
    }
}

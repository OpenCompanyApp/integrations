<?php

namespace OpenCompany\Integrations\OpenMeteo;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoAirQuality;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoClimate;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoElevation;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoEnsemble;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoFlood;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoForecast;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoGeocodingGet;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoGeocodingSearch;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoHistoricalForecast;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoHistoricalWeather;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoMarine;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoModelForecast;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoSatelliteRadiation;
use OpenCompany\Integrations\OpenMeteo\Tools\OpenMeteoSeasonalForecast;

/**
 * Tool catalog and metadata for Open-Meteo.
 *
 * Exposes public weather, climate, marine, air quality, flood, elevation, and
 * geocoding APIs without requiring credentials for standard non-commercial use.
 */
class OpenMeteoToolProvider implements ToolProvider, HasIntegrationCapabilities
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
                'strategy' => 'none',
                'legacy_auth_type' => 'none',
                'credential_mode' => 'none',
                'setup_flows' => ['none'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['Public Open-Meteo endpoints require no credentials for standard non-commercial use.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'open-meteo';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Open-Meteo',
            'description' => 'Weather, climate, marine, air quality, flood, elevation, and geocoding data',
            'icon' => 'ph:cloud-sun',
            'logo' => 'ph:cloud-sun',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Open-Meteo',
            'description' => 'Public Open-Meteo APIs for forecasts, historical weather, climate projections, marine conditions, air quality, flood forecasts, elevation, and geocoding.',
            'icon' => 'ph:cloud-sun',
            'logo' => 'ph:cloud-sun',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://open-meteo.com/en/docs',
        ];
    }

    public function tools(): array
    {
        return [
            'open_meteo_forecast' => [
                'class' => OpenMeteoForecast::class,
                'type' => 'read',
                'name' => 'Weather Forecast',
                'description' => 'Get standard Open-Meteo forecast data.',
                'icon' => 'ph:cloud-sun',
            ],
            'open_meteo_model_forecast' => [
                'class' => OpenMeteoModelForecast::class,
                'type' => 'read',
                'name' => 'Model Forecast',
                'description' => 'Get forecast data from a specific Open-Meteo model endpoint.',
                'icon' => 'ph:cloud-sun',
            ],
            'open_meteo_historical_weather' => [
                'class' => OpenMeteoHistoricalWeather::class,
                'type' => 'read',
                'name' => 'Historical Weather',
                'description' => 'Get historical weather archive data.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'open_meteo_historical_forecast' => [
                'class' => OpenMeteoHistoricalForecast::class,
                'type' => 'read',
                'name' => 'Historical Forecast',
                'description' => 'Get past forecast model runs.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'open_meteo_ensemble' => [
                'class' => OpenMeteoEnsemble::class,
                'type' => 'read',
                'name' => 'Ensemble Forecast',
                'description' => 'Get ensemble forecast data.',
                'icon' => 'ph:cloud-sun',
            ],
            'open_meteo_seasonal_forecast' => [
                'class' => OpenMeteoSeasonalForecast::class,
                'type' => 'read',
                'name' => 'Seasonal Forecast',
                'description' => 'Get seasonal and sub-seasonal forecast data.',
                'icon' => 'ph:calendar',
            ],
            'open_meteo_climate' => [
                'class' => OpenMeteoClimate::class,
                'type' => 'read',
                'name' => 'Climate Projections',
                'description' => 'Get climate projection data.',
                'icon' => 'ph:globe-hemisphere-west',
            ],
            'open_meteo_marine' => [
                'class' => OpenMeteoMarine::class,
                'type' => 'read',
                'name' => 'Marine Forecast',
                'description' => 'Get marine weather and wave forecasts.',
                'icon' => 'ph:waves',
            ],
            'open_meteo_air_quality' => [
                'class' => OpenMeteoAirQuality::class,
                'type' => 'read',
                'name' => 'Air Quality',
                'description' => 'Get air quality forecasts.',
                'icon' => 'ph:wind',
            ],
            'open_meteo_satellite_radiation' => [
                'class' => OpenMeteoSatelliteRadiation::class,
                'type' => 'read',
                'name' => 'Satellite Radiation',
                'description' => 'Get satellite radiation data.',
                'icon' => 'ph:sun',
            ],
            'open_meteo_flood' => [
                'class' => OpenMeteoFlood::class,
                'type' => 'read',
                'name' => 'Flood Forecast',
                'description' => 'Get flood and river discharge forecasts.',
                'icon' => 'ph:drop',
            ],
            'open_meteo_elevation' => [
                'class' => OpenMeteoElevation::class,
                'type' => 'read',
                'name' => 'Elevation',
                'description' => 'Get elevation for coordinates.',
                'icon' => 'ph:mountains',
            ],
            'open_meteo_geocoding_search' => [
                'class' => OpenMeteoGeocodingSearch::class,
                'type' => 'read',
                'name' => 'Geocoding Search',
                'description' => 'Search locations by name or postal code.',
                'icon' => 'ph:magnifying-glass',
            ],
            'open_meteo_geocoding_get' => [
                'class' => OpenMeteoGeocodingGet::class,
                'type' => 'read',
                'name' => 'Geocoding Get',
                'description' => 'Resolve a geocoding location ID.',
                'icon' => 'ph:map-pin',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function credentialFields(): array
    {
        return [];
    }

    /**
     * Create an Open-Meteo tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context, unused for public endpoints.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(OpenMeteoService::class));
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/open-meteo.md';
    }
}

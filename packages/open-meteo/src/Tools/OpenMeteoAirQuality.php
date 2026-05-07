<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo air quality forecast data.
 */
class OpenMeteoAirQuality extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_air_quality';
    protected const DESCRIPTION = 'Get air quality forecasts from Open-Meteo.

Official endpoint: GET https://air-quality-api.open-meteo.com/v1/air-quality';
    protected const ENDPOINT = 'air_quality';
    protected const REQUIRED = ['latitude', 'longitude'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'current' => ['type' => 'array', 'required' => false, 'description' => 'Current air quality variables.', 'items' => ['type' => 'string']],
        'hourly' => ['type' => 'array', 'required' => false, 'description' => 'Hourly air quality variables such as pm10, pm2_5, ozone, nitrogen_dioxide, or us_aqi.', 'items' => ['type' => 'string']],
        'domains' => ['type' => 'string', 'required' => false, 'description' => 'Domain selection such as auto, cams_global, or cams_europe.'],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for daily aggregation.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official air quality query parameters.'],
    ];
}

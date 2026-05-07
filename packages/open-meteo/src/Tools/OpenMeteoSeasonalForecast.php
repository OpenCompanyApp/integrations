<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo seasonal and sub-seasonal forecasts.
 */
class OpenMeteoSeasonalForecast extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_seasonal_forecast';
    protected const DESCRIPTION = 'Get seasonal and sub-seasonal forecast data from Open-Meteo.

Official endpoint: GET https://seasonal-api.open-meteo.com/v1/seasonal';
    protected const ENDPOINT = 'seasonal';
    protected const REQUIRED = ['latitude', 'longitude'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'daily' => ['type' => 'array', 'required' => false, 'description' => 'Daily seasonal variables.', 'items' => ['type' => 'string']],
        'monthly' => ['type' => 'array', 'required' => false, 'description' => 'Monthly seasonal variables.', 'items' => ['type' => 'string']],
        'models' => ['type' => 'array', 'required' => false, 'description' => 'Seasonal model selection.', 'items' => ['type' => 'string']],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for aggregation.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official seasonal query parameters.'],
    ];
}

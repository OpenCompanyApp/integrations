<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo flood forecast data.
 */
class OpenMeteoFlood extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_flood';
    protected const DESCRIPTION = 'Get flood and river discharge forecasts from Open-Meteo.

Official endpoint: GET https://flood-api.open-meteo.com/v1/flood';
    protected const ENDPOINT = 'flood';
    protected const REQUIRED = ['latitude', 'longitude'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'daily' => ['type' => 'array', 'required' => false, 'description' => 'Daily flood variables such as river_discharge.', 'items' => ['type' => 'string']],
        'models' => ['type' => 'array', 'required' => false, 'description' => 'Flood model selection.', 'items' => ['type' => 'string']],
        'forecast_days' => ['type' => 'integer', 'required' => false, 'description' => 'Number of forecast days.'],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for daily data.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official flood query parameters.'],
    ];
}

<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo marine forecast data.
 */
class OpenMeteoMarine extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_marine';
    protected const DESCRIPTION = 'Get marine weather and wave forecasts from Open-Meteo.

Official endpoint: GET https://marine-api.open-meteo.com/v1/marine';
    protected const ENDPOINT = 'marine';
    protected const REQUIRED = ['latitude', 'longitude'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'current' => ['type' => 'array', 'required' => false, 'description' => 'Current marine variables.', 'items' => ['type' => 'string']],
        'hourly' => ['type' => 'array', 'required' => false, 'description' => 'Hourly marine variables.', 'items' => ['type' => 'string']],
        'daily' => ['type' => 'array', 'required' => false, 'description' => 'Daily marine variables.', 'items' => ['type' => 'string']],
        'minutely_15' => ['type' => 'array', 'required' => false, 'description' => '15-minute marine variables.', 'items' => ['type' => 'string']],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for daily aggregation.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official marine query parameters.'],
    ];
}

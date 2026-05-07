<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo historical weather archive data.
 *
 * Covers the official archive endpoint for ERA5 and other historical datasets.
 */
class OpenMeteoHistoricalWeather extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_historical_weather';
    protected const DESCRIPTION = 'Get historical weather archive data from Open-Meteo.

Official endpoint: GET https://archive-api.open-meteo.com/v1/archive
Requires latitude, longitude, start_date, and end_date.';
    protected const ENDPOINT = 'archive';
    protected const REQUIRED = ['latitude', 'longitude', 'start_date', 'end_date'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'start_date' => ['type' => 'string', 'required' => true, 'description' => 'Start date in YYYY-MM-DD format.'],
        'end_date' => ['type' => 'string', 'required' => true, 'description' => 'End date in YYYY-MM-DD format.'],
        'hourly' => ['type' => 'array', 'required' => false, 'description' => 'Hourly historical variables.', 'items' => ['type' => 'string']],
        'daily' => ['type' => 'array', 'required' => false, 'description' => 'Daily historical variables.', 'items' => ['type' => 'string']],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for daily aggregation.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official historical weather query parameters.'],
    ];
}

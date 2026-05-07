<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve past Open-Meteo forecast model runs.
 *
 * Covers historical forecasts from 2022 onward where available.
 */
class OpenMeteoHistoricalForecast extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_historical_forecast';
    protected const DESCRIPTION = 'Get historical forecast model runs from Open-Meteo.

Official endpoint: GET https://historical-forecast-api.open-meteo.com/v1/forecast';
    protected const ENDPOINT = 'historical_forecast';
    protected const REQUIRED = ['latitude', 'longitude', 'start_date', 'end_date'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'start_date' => ['type' => 'string', 'required' => true, 'description' => 'Start date in YYYY-MM-DD format.'],
        'end_date' => ['type' => 'string', 'required' => true, 'description' => 'End date in YYYY-MM-DD format.'],
        'hourly' => ['type' => 'array', 'required' => false, 'description' => 'Hourly forecast variables.', 'items' => ['type' => 'string']],
        'daily' => ['type' => 'array', 'required' => false, 'description' => 'Daily forecast variables.', 'items' => ['type' => 'string']],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for daily aggregation.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official historical forecast query parameters.'],
    ];
}

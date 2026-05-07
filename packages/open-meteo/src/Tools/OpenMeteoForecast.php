<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve the standard Open-Meteo weather forecast.
 *
 * Covers the official `/v1/forecast` endpoint with current, hourly, daily,
 * minutely, units, timezone, and forecast-window parameters.
 */
class OpenMeteoForecast extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_forecast';
    protected const DESCRIPTION = 'Get weather forecast data from Open-Meteo.

Official endpoint: GET https://api.open-meteo.com/v1/forecast
Use hourly, daily, current, or minutely_15 arrays to select variables.';
    protected const ENDPOINT = 'forecast';
    protected const REQUIRED = ['latitude', 'longitude'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude, or an array/comma list for multiple locations.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude, or an array/comma list for multiple locations.'],
        'current' => ['type' => 'array', 'required' => false, 'description' => 'Current weather variables.', 'items' => ['type' => 'string']],
        'hourly' => ['type' => 'array', 'required' => false, 'description' => 'Hourly weather variables.', 'items' => ['type' => 'string']],
        'daily' => ['type' => 'array', 'required' => false, 'description' => 'Daily weather variables.', 'items' => ['type' => 'string']],
        'minutely_15' => ['type' => 'array', 'required' => false, 'description' => '15-minute weather variables where available.', 'items' => ['type' => 'string']],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone such as UTC, auto, or Europe/Berlin.'],
        'forecast_days' => ['type' => 'integer', 'required' => false, 'description' => 'Number of forecast days, up to the endpoint limit.'],
        'past_days' => ['type' => 'integer', 'required' => false, 'description' => 'Number of past forecast days to include.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official Open-Meteo forecast query parameters.'],
    ];
}

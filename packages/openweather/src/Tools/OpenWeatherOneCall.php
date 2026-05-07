<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Retrieve OpenWeather One Call API 3.0 current and forecast data.
 */
class OpenWeatherOneCall extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_one_call';
    protected const DESCRIPTION = 'Get One Call API 3.0 current weather, minutely forecast, hourly forecast, daily forecast, and alerts.

Official endpoint: GET https://api.openweathermap.org/data/3.0/onecall';
    protected const ENDPOINT = 'one_call';
    protected const REQUIRED = ['lat', 'lon'];
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'exclude' => ['type' => 'array', 'required' => false, 'description' => 'Parts to exclude: current, minutely, hourly, daily, alerts.', 'items' => ['type' => 'string']],
        'units' => ['type' => 'string', 'required' => false, 'description' => 'Units: standard, metric, or imperial.', 'enum' => ['standard', 'metric', 'imperial']],
        'lang' => ['type' => 'string', 'required' => false, 'description' => 'Language code for weather descriptions.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official One Call query parameters.'],
    ];
}

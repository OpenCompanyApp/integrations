<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Retrieve OpenWeather 5 day / 3 hour forecast data.
 */
class OpenWeatherForecast5Day extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_forecast_5_day';
    protected const DESCRIPTION = 'Get 5 day / 3 hour forecast data from OpenWeather.

Official endpoint: GET https://api.openweathermap.org/data/2.5/forecast';
    protected const ENDPOINT = 'forecast_5_day';
    protected const REQUIRE_LOCATION = true;
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => false, 'description' => 'Latitude. Required with lon for coordinate lookup.'],
        'lon' => ['type' => 'number', 'required' => false, 'description' => 'Longitude. Required with lat for coordinate lookup.'],
        'q' => ['type' => 'string', 'required' => false, 'description' => 'Legacy city name selector such as London,GB.'],
        'id' => ['type' => 'integer', 'required' => false, 'description' => 'Legacy OpenWeather city ID selector.'],
        'zip' => ['type' => 'string', 'required' => false, 'description' => 'Legacy zip selector such as 90210,US.'],
        'cnt' => ['type' => 'integer', 'required' => false, 'description' => 'Number of timestamps to return.'],
        'units' => ['type' => 'string', 'required' => false, 'description' => 'Units: standard, metric, or imperial.', 'enum' => ['standard', 'metric', 'imperial']],
        'lang' => ['type' => 'string', 'required' => false, 'description' => 'Language code for weather descriptions.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official forecast query parameters.'],
    ];
}

<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Retrieve current weather data from OpenWeather.
 */
class OpenWeatherCurrentWeather extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_current_weather';
    protected const DESCRIPTION = 'Get current weather data from OpenWeather.

Official endpoint: GET https://api.openweathermap.org/data/2.5/weather
Use latitude/longitude for current supported behavior, or legacy q, id, or zip selectors when needed.';
    protected const ENDPOINT = 'current_weather';
    protected const REQUIRE_LOCATION = true;
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => false, 'description' => 'Latitude. Required with lon for coordinate lookup.'],
        'lon' => ['type' => 'number', 'required' => false, 'description' => 'Longitude. Required with lat for coordinate lookup.'],
        'q' => ['type' => 'string', 'required' => false, 'description' => 'Legacy city name selector such as London,GB.'],
        'id' => ['type' => 'integer', 'required' => false, 'description' => 'Legacy OpenWeather city ID selector.'],
        'zip' => ['type' => 'string', 'required' => false, 'description' => 'Legacy zip selector such as 90210,US.'],
        'units' => ['type' => 'string', 'required' => false, 'description' => 'Units: standard, metric, or imperial.', 'enum' => ['standard', 'metric', 'imperial']],
        'lang' => ['type' => 'string', 'required' => false, 'description' => 'Language code for weather descriptions.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official current weather query parameters.'],
    ];
}

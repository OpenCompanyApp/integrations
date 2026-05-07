<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Retrieve OpenWeather One Call historical data for a timestamp.
 */
class OpenWeatherOneCallTimemachine extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_one_call_timemachine';
    protected const DESCRIPTION = 'Get One Call API 3.0 weather data for a Unix timestamp.

Official endpoint: GET https://api.openweathermap.org/data/3.0/onecall/timemachine';
    protected const ENDPOINT = 'one_call_timemachine';
    protected const REQUIRED = ['lat', 'lon', 'dt'];
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'dt' => ['type' => 'integer', 'required' => true, 'description' => 'Unix timestamp in UTC.'],
        'units' => ['type' => 'string', 'required' => false, 'description' => 'Units: standard, metric, or imperial.', 'enum' => ['standard', 'metric', 'imperial']],
        'lang' => ['type' => 'string', 'required' => false, 'description' => 'Language code for weather descriptions.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official timemachine query parameters.'],
    ];
}

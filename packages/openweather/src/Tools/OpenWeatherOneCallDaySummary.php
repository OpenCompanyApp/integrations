<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Retrieve OpenWeather One Call daily aggregation.
 */
class OpenWeatherOneCallDaySummary extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_one_call_day_summary';
    protected const DESCRIPTION = 'Get One Call API 3.0 daily aggregation for a date.

Official endpoint: GET https://api.openweathermap.org/data/3.0/onecall/day_summary';
    protected const ENDPOINT = 'one_call_day_summary';
    protected const REQUIRED = ['lat', 'lon', 'date'];
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'date' => ['type' => 'string', 'required' => true, 'description' => 'Date in YYYY-MM-DD format.'],
        'tz' => ['type' => 'string', 'required' => false, 'description' => 'Manual timezone offset in +/-HH:MM format.'],
        'units' => ['type' => 'string', 'required' => false, 'description' => 'Units: standard, metric, or imperial.', 'enum' => ['standard', 'metric', 'imperial']],
        'lang' => ['type' => 'string', 'required' => false, 'description' => 'Language code for weather descriptions.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official day summary query parameters.'],
    ];
}

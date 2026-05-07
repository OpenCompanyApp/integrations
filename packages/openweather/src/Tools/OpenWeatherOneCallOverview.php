<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Retrieve OpenWeather's human-readable weather overview.
 */
class OpenWeatherOneCallOverview extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_one_call_overview';
    protected const DESCRIPTION = 'Get One Call API 3.0 weather overview summary.

Official endpoint: GET https://api.openweathermap.org/data/3.0/onecall/overview';
    protected const ENDPOINT = 'one_call_overview';
    protected const REQUIRED = ['lat', 'lon'];
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'date' => ['type' => 'string', 'required' => false, 'description' => 'Optional date in YYYY-MM-DD format when supported by the API.'],
        'units' => ['type' => 'string', 'required' => false, 'description' => 'Units: standard, metric, or imperial.', 'enum' => ['standard', 'metric', 'imperial']],
        'lang' => ['type' => 'string', 'required' => false, 'description' => 'Language code for summary output.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official overview query parameters.'],
    ];
}

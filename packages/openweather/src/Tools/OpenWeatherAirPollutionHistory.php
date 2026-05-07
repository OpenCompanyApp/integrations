<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Retrieve historical air pollution data.
 */
class OpenWeatherAirPollutionHistory extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_air_pollution_history';
    protected const DESCRIPTION = 'Get historical air pollution data from OpenWeather.

Official endpoint: GET https://api.openweathermap.org/data/2.5/air_pollution/history';
    protected const ENDPOINT = 'air_pollution_history';
    protected const REQUIRED = ['lat', 'lon', 'start', 'end'];
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'start' => ['type' => 'integer', 'required' => true, 'description' => 'Start Unix timestamp.'],
        'end' => ['type' => 'integer', 'required' => true, 'description' => 'End Unix timestamp.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official air pollution history query parameters.'],
    ];
}

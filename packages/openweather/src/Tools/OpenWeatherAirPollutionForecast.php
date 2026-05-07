<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Retrieve forecasted air pollution data.
 */
class OpenWeatherAirPollutionForecast extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_air_pollution_forecast';
    protected const DESCRIPTION = 'Get forecasted air pollution data from OpenWeather.

Official endpoint: GET https://api.openweathermap.org/data/2.5/air_pollution/forecast';
    protected const ENDPOINT = 'air_pollution_forecast';
    protected const REQUIRED = ['lat', 'lon'];
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official air pollution forecast query parameters.'],
    ];
}

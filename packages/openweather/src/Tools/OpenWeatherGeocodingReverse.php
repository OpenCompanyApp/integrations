<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Convert coordinates into nearby location names with OpenWeather geocoding.
 */
class OpenWeatherGeocodingReverse extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_geocoding_reverse';
    protected const DESCRIPTION = 'Convert coordinates into nearby location names.

Official endpoint: GET https://api.openweathermap.org/geo/1.0/reverse';
    protected const ENDPOINT = 'geocoding_reverse';
    protected const REQUIRED = ['lat', 'lon'];
    protected const PARAMETERS = [
        'lat' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'lon' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of locations to return.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official reverse geocoding query parameters.'],
    ];
}

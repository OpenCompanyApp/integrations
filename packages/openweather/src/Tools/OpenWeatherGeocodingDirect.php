<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Convert a location name into coordinates with OpenWeather geocoding.
 */
class OpenWeatherGeocodingDirect extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_geocoding_direct';
    protected const DESCRIPTION = 'Convert a city, state, and country query into coordinates.

Official endpoint: GET https://api.openweathermap.org/geo/1.0/direct';
    protected const ENDPOINT = 'geocoding_direct';
    protected const REQUIRED = ['q'];
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'City name, optionally state code and country code, separated by commas.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum number of locations to return, up to 5.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official direct geocoding query parameters.'],
    ];
}

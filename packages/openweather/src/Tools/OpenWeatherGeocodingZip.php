<?php

namespace OpenCompany\Integrations\OpenWeather\Tools;

/**
 * Convert a zip or post code into coordinates with OpenWeather geocoding.
 */
class OpenWeatherGeocodingZip extends AbstractOpenWeatherTool
{
    protected const NAME = 'openweather_geocoding_zip';
    protected const DESCRIPTION = 'Convert a zip or post code into coordinates.

Official endpoint: GET https://api.openweathermap.org/geo/1.0/zip';
    protected const ENDPOINT = 'geocoding_zip';
    protected const REQUIRED = ['zip'];
    protected const PARAMETERS = [
        'zip' => ['type' => 'string', 'required' => true, 'description' => 'Zip/post code and country code, for example 90210,US.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official zip geocoding query parameters.'],
    ];
}

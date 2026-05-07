<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Resolve a location ID with the Open-Meteo Geocoding API.
 */
class OpenMeteoGeocodingGet extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_geocoding_get';
    protected const DESCRIPTION = 'Resolve an Open-Meteo geocoding location ID.

Official endpoint: GET https://geocoding-api.open-meteo.com/v1/get';
    protected const ENDPOINT = 'geocoding_get';
    protected const REQUIRED = ['id'];
    protected const PARAMETERS = [
        'id' => ['type' => 'integer', 'required' => true, 'description' => 'Open-Meteo/GeoNames location ID from geocoding search results.'],
        'language' => ['type' => 'string', 'required' => false, 'description' => 'Lowercase language code for translated names.'],
        'format' => ['type' => 'string', 'required' => false, 'description' => 'Response format, normally json.', 'enum' => ['json', 'protobuf']],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official geocoding get query parameters.'],
    ];
}

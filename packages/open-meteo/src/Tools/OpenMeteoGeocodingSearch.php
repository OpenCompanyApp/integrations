<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Search locations with the Open-Meteo Geocoding API.
 */
class OpenMeteoGeocodingSearch extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_geocoding_search';
    protected const DESCRIPTION = 'Search locations globally with Open-Meteo geocoding.

Official endpoint: GET https://geocoding-api.open-meteo.com/v1/search';
    protected const ENDPOINT = 'geocoding_search';
    protected const REQUIRED = ['name'];
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Location name or postal code to search.'],
        'count' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results to return, up to 100.'],
        'language' => ['type' => 'string', 'required' => false, 'description' => 'Lowercase language code for translated names.'],
        'countryCode' => ['type' => 'string', 'required' => false, 'description' => 'ISO-3166-1 alpha-2 country code filter.'],
        'format' => ['type' => 'string', 'required' => false, 'description' => 'Response format, normally json.', 'enum' => ['json', 'protobuf']],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official geocoding search query parameters.'],
    ];
}

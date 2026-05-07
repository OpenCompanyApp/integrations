<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo elevation data.
 */
class OpenMeteoElevation extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_elevation';
    protected const DESCRIPTION = 'Get elevation for one or more coordinates from Open-Meteo.

Official endpoint: GET https://api.open-meteo.com/v1/elevation';
    protected const ENDPOINT = 'elevation';
    protected const REQUIRED = ['latitude', 'longitude'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude, or an array/comma list for multiple coordinates.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude, or an array/comma list for multiple coordinates.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official elevation query parameters.'],
    ];
}

<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo satellite radiation data.
 */
class OpenMeteoSatelliteRadiation extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_satellite_radiation';
    protected const DESCRIPTION = 'Get satellite radiation data from Open-Meteo.

Official endpoint: GET https://satellite-api.open-meteo.com/v1/satellite-radiation';
    protected const ENDPOINT = 'satellite_radiation';
    protected const REQUIRED = ['latitude', 'longitude'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'hourly' => ['type' => 'array', 'required' => false, 'description' => 'Hourly satellite radiation variables.', 'items' => ['type' => 'string']],
        'current' => ['type' => 'array', 'required' => false, 'description' => 'Current satellite radiation variables.', 'items' => ['type' => 'string']],
        'tilt' => ['type' => 'number', 'required' => false, 'description' => 'Panel tilt for global tilted irradiance.'],
        'azimuth' => ['type' => 'number', 'required' => false, 'description' => 'Panel azimuth for global tilted irradiance.'],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for returned data.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official satellite radiation query parameters.'],
    ];
}

<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve forecasts from a specific Open-Meteo model endpoint.
 *
 * Supports documented model paths such as gfs, ecmwf, icon, meteofrance,
 * ukmo, jma, kma, metno, gem, bom, cma, knmi, dmi, and meteoitalia.
 */
class OpenMeteoModelForecast extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_model_forecast';
    protected const DESCRIPTION = 'Get forecast data from a specific Open-Meteo model endpoint.

Official endpoint shape: GET https://api.open-meteo.com/v1/{model_endpoint}
Use this for documented model APIs such as gfs, ecmwf, icon, meteofrance, ukmo, jma, kma, metno, gem, bom, cma, knmi, dmi, and meteoitalia.';
    protected const ENDPOINT = 'model_forecast';
    protected const REQUIRED = ['model_endpoint', 'latitude', 'longitude'];
    protected const PARAMETERS = [
        'model_endpoint' => ['type' => 'string', 'required' => true, 'description' => 'Open-Meteo model endpoint slug, for example gfs, ecmwf, icon, meteofrance, ukmo, jma, kma, metno, gem, bom, cma, knmi, dmi, or meteoitalia.'],
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'hourly' => ['type' => 'array', 'required' => false, 'description' => 'Hourly variables supported by the selected model endpoint.', 'items' => ['type' => 'string']],
        'daily' => ['type' => 'array', 'required' => false, 'description' => 'Daily variables supported by the selected model endpoint.', 'items' => ['type' => 'string']],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone such as UTC, auto, or Europe/Berlin.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official model endpoint query parameters.'],
    ];
}

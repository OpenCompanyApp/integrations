<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo climate projection data.
 */
class OpenMeteoClimate extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_climate';
    protected const DESCRIPTION = 'Get climate projection data from Open-Meteo.

Official endpoint: GET https://climate-api.open-meteo.com/v1/climate
Requires latitude, longitude, start_date, end_date, models, and daily variables.';
    protected const ENDPOINT = 'climate';
    protected const REQUIRED = ['latitude', 'longitude', 'start_date', 'end_date', 'models', 'daily'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'start_date' => ['type' => 'string', 'required' => true, 'description' => 'Start date in YYYY-MM-DD format.'],
        'end_date' => ['type' => 'string', 'required' => true, 'description' => 'End date in YYYY-MM-DD format.'],
        'models' => ['type' => 'array', 'required' => true, 'description' => 'Climate model IDs such as CMCC_CM2_VHR4 or MPI_ESM1_2_XR.', 'items' => ['type' => 'string']],
        'daily' => ['type' => 'array', 'required' => true, 'description' => 'Daily climate variables.', 'items' => ['type' => 'string']],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for daily data.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official climate query parameters.'],
    ];
}

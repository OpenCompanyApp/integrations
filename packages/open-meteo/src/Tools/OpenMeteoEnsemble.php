<?php

namespace OpenCompany\Integrations\OpenMeteo\Tools;

/**
 * Retrieve Open-Meteo ensemble forecast data.
 */
class OpenMeteoEnsemble extends AbstractOpenMeteoTool
{
    protected const NAME = 'open_meteo_ensemble';
    protected const DESCRIPTION = 'Get ensemble forecast data from Open-Meteo.

Official endpoint: GET https://ensemble-api.open-meteo.com/v1/ensemble';
    protected const ENDPOINT = 'ensemble';
    protected const REQUIRED = ['latitude', 'longitude'];
    protected const PARAMETERS = [
        'latitude' => ['type' => 'number', 'required' => true, 'description' => 'Latitude.'],
        'longitude' => ['type' => 'number', 'required' => true, 'description' => 'Longitude.'],
        'hourly' => ['type' => 'array', 'required' => false, 'description' => 'Hourly ensemble variables.', 'items' => ['type' => 'string']],
        'daily' => ['type' => 'array', 'required' => false, 'description' => 'Daily ensemble variables.', 'items' => ['type' => 'string']],
        'models' => ['type' => 'array', 'required' => false, 'description' => 'Ensemble model selection.', 'items' => ['type' => 'string']],
        'timezone' => ['type' => 'string', 'required' => false, 'description' => 'Timezone for daily aggregation.'],
        'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official ensemble query parameters.'],
    ];
}

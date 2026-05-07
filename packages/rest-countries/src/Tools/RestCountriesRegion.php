<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Filter countries by region.
 */
class RestCountriesRegion extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_region';
    protected const DESCRIPTION = 'Filter countries by region.';
    protected const METHOD = 'region';
    protected const REQUIRED = ['region'];
    protected const PARAMETERS = [
        'region' => ['type' => 'string', 'required' => true, 'description' => 'Region name, such as europe, asia, africa, americas, oceania, or antarctic.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

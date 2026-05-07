<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Search countries by capital city.
 */
class RestCountriesCapital extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_capital';
    protected const DESCRIPTION = 'Search countries by capital city.';
    protected const METHOD = 'capital';
    protected const REQUIRED = ['capital'];
    protected const PARAMETERS = [
        'capital' => ['type' => 'string', 'required' => true, 'description' => 'Capital city name, such as Tallinn.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

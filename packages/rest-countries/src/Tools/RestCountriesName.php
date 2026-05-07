<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Search countries by common or official name.
 */
class RestCountriesName extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_name';
    protected const DESCRIPTION = 'Search countries by common or official country name.';
    protected const METHOD = 'name';
    protected const REQUIRED = ['name'];
    protected const PARAMETERS = [
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Country name search term.'],
        'full_text' => ['type' => 'boolean', 'required' => false, 'description' => 'When true, require a full country name match.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

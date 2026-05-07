<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Filter countries by subregion.
 */
class RestCountriesSubregion extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_subregion';
    protected const DESCRIPTION = 'Filter countries by subregion.';
    protected const METHOD = 'subregion';
    protected const REQUIRED = ['subregion'];
    protected const PARAMETERS = [
        'subregion' => ['type' => 'string', 'required' => true, 'description' => 'Subregion name, such as Northern Europe or Southern Asia.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

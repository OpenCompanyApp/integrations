<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Retrieve countries by independence status.
 */
class RestCountriesIndependent extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_independent';
    protected const DESCRIPTION = 'Retrieve all independent or non-independent countries.';
    protected const METHOD = 'independent';
    protected const REQUIRED = ['status'];
    protected const PARAMETERS = [
        'status' => ['type' => 'boolean', 'required' => true, 'description' => 'True for independent countries, false for non-independent countries.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

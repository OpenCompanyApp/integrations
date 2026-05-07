<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Retrieve one country by code.
 */
class RestCountriesAlpha extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_alpha';
    protected const DESCRIPTION = 'Retrieve one country by cca2, ccn3, cca3, or cioc country code.';
    protected const METHOD = 'alpha';
    protected const REQUIRED = ['code'];
    protected const PARAMETERS = [
        'code' => ['type' => 'string', 'required' => true, 'description' => 'Country code, such as DE, DEU, 276, or GER.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

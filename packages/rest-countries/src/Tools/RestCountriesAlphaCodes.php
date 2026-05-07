<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Retrieve multiple countries by code list.
 */
class RestCountriesAlphaCodes extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_alpha_codes';
    protected const DESCRIPTION = 'Retrieve multiple countries by comma-separated cca2, ccn3, cca3, or cioc country codes.';
    protected const METHOD = 'alphaCodes';
    protected const REQUIRED = ['codes'];
    protected const PARAMETERS = [
        'codes' => ['type' => 'string', 'required' => true, 'description' => 'Comma-separated country codes, such as 170,no,est,pe.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

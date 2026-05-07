<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Retrieve all countries with selected fields.
 */
class RestCountriesAll extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_all';
    protected const DESCRIPTION = 'Retrieve all countries. REST Countries requires a fields filter on this endpoint; a compact default is used when omitted.';
    protected const METHOD = 'all';
    protected const PARAMETERS = [
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10. Default: name,cca2,cca3,capital,region,subregion,population,flags.'],
    ];
}

<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Search countries by currency.
 */
class RestCountriesCurrency extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_currency';
    protected const DESCRIPTION = 'Search countries by currency code or currency name.';
    protected const METHOD = 'currency';
    protected const REQUIRED = ['currency'];
    protected const PARAMETERS = [
        'currency' => ['type' => 'string', 'required' => true, 'description' => 'Currency code or name, such as eur or euro.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

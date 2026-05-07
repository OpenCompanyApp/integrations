<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Search countries by translated name.
 */
class RestCountriesTranslation extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_translation';
    protected const DESCRIPTION = 'Search countries by any translated country name.';
    protected const METHOD = 'translation';
    protected const REQUIRED = ['translation'];
    protected const PARAMETERS = [
        'translation' => ['type' => 'string', 'required' => true, 'description' => 'Translated country name, such as Alemania.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

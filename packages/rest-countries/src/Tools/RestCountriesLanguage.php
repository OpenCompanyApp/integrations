<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Search countries by language.
 */
class RestCountriesLanguage extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_language';
    protected const DESCRIPTION = 'Search countries by language code or language name.';
    protected const METHOD = 'language';
    protected const REQUIRED = ['language'];
    protected const PARAMETERS = [
        'language' => ['type' => 'string', 'required' => true, 'description' => 'Language code or name, such as spa or spanish.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

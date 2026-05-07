<?php

namespace OpenCompany\Integrations\RestCountries\Tools;

/**
 * Search countries by demonym.
 */
class RestCountriesDemonym extends AbstractRestCountriesTool
{
    protected const NAME = 'rest_countries_demonym';
    protected const DESCRIPTION = 'Search countries by how a citizen is called, such as Peruvian.';
    protected const METHOD = 'demonym';
    protected const REQUIRED = ['demonym'];
    protected const PARAMETERS = [
        'demonym' => ['type' => 'string', 'required' => true, 'description' => 'Demonym, such as Peruvian.'],
        'fields' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated response fields, maximum 10.'],
    ];
}

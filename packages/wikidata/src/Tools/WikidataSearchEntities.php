<?php

namespace OpenCompany\Integrations\Wikidata\Tools;

/**
 * Search Wikidata entities.
 */
class WikidataSearchEntities extends AbstractWikidataTool
{
    protected const NAME = 'wikidata_search_entities';
    protected const DESCRIPTION = 'Search Wikidata items or properties with wbsearchentities.';
    protected const METHOD = 'searchEntities';
    protected const REQUIRED = ['search'];
    protected const PARAMETERS = [
        'search' => ['type' => 'string', 'required' => true, 'description' => 'Search string, such as New York City or instance of.'],
        'language' => ['type' => 'string', 'required' => false, 'description' => 'Search language code. Default: en.'],
        'uselang' => ['type' => 'string', 'required' => false, 'description' => 'UI/result language code. Defaults to language.'],
        'type' => ['type' => 'string', 'required' => false, 'description' => 'Entity type.', 'enum' => ['item', 'property']],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results.'],
        'continue' => ['type' => 'integer', 'required' => false, 'description' => 'Continuation offset from a previous response.'],
    ];
}

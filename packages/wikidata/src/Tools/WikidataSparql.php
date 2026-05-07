<?php

namespace OpenCompany\Integrations\Wikidata\Tools;

/**
 * Execute a Wikidata SPARQL query.
 */
class WikidataSparql extends AbstractWikidataTool
{
    protected const NAME = 'wikidata_sparql';
    protected const DESCRIPTION = 'Execute a Wikidata Query Service SPARQL query and return JSON results.';
    protected const METHOD = 'sparql';
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'SPARQL query. Keep queries selective and bounded.'],
        'timeout' => ['type' => 'integer', 'required' => false, 'description' => 'Optional query timeout in milliseconds.'],
    ];
}

<?php

namespace OpenCompany\Integrations\Orcid\Tools;

/**
 * Search the ORCID registry with Solr syntax.
 */
class OrcidSearch extends AbstractOrcidTool
{
    protected const NAME = 'orcid_search';
    protected const DESCRIPTION = 'Search the ORCID registry with Solr query syntax and return matching ORCID identifiers.';
    protected const PATH = 'search';
    protected const REQUIRED = ['q'];
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => true, 'description' => 'Solr search query.'],
        'start' => ['type' => 'integer', 'required' => false, 'description' => 'Zero-based result offset.'],
        'rows' => ['type' => 'integer', 'required' => false, 'description' => 'Number of results to return.'],
    ];
}

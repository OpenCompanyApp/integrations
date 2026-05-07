<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Search authors by name.
 */
class SemanticScholarSearchAuthors extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_search_authors';
    protected const DESCRIPTION = 'Search Semantic Scholar authors by name using /graph/v1/author/search.';
    protected const PATH = 'author/search';
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Author name query.'],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
    ];
}

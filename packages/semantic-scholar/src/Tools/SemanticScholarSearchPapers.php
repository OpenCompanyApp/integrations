<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Search papers by relevance in the Academic Graph API.
 */
class SemanticScholarSearchPapers extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_search_papers';
    protected const DESCRIPTION = 'Search Semantic Scholar papers by relevance using /graph/v1/paper/search.';
    protected const PATH = 'paper/search';
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return, such as title,year,authors,citationCount.', 'items' => ['type' => 'string']],
        'publicationTypes' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Publication type filters.', 'items' => ['type' => 'string']],
        'openAccessPdf' => ['type' => 'boolean', 'required' => false, 'description' => 'Filter to papers with open-access PDFs.'],
        'minCitationCount' => ['type' => 'integer', 'required' => false, 'description' => 'Minimum citation count.'],
        'publicationDateOrYear' => ['type' => 'string', 'required' => false, 'description' => 'Publication date or year range.'],
        'year' => ['type' => 'string', 'required' => false, 'description' => 'Year or year range.'],
        'venue' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Venue filters.', 'items' => ['type' => 'string']],
        'fieldsOfStudy' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields of study filters.', 'items' => ['type' => 'string']],
        'offset' => ['type' => 'integer', 'required' => false, 'description' => 'Result offset.'],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
    ];
}

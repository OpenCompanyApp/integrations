<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Search for a paper by title.
 */
class SemanticScholarTitleSearchPapers extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_title_search_papers';
    protected const DESCRIPTION = 'Search Semantic Scholar papers by title using /graph/v1/paper/search/match.';
    protected const PATH = 'paper/search/match';
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Paper title query.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
        'publicationTypes' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Publication type filters.', 'items' => ['type' => 'string']],
        'openAccessPdf' => ['type' => 'boolean', 'required' => false, 'description' => 'Filter to papers with open-access PDFs.'],
        'minCitationCount' => ['type' => 'integer', 'required' => false, 'description' => 'Minimum citation count.'],
        'publicationDateOrYear' => ['type' => 'string', 'required' => false, 'description' => 'Publication date or year range.'],
        'year' => ['type' => 'string', 'required' => false, 'description' => 'Year or year range.'],
        'venue' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Venue filters.', 'items' => ['type' => 'string']],
        'fieldsOfStudy' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields of study filters.', 'items' => ['type' => 'string']],
    ];
}

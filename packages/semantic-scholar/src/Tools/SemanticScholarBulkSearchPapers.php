<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Bulk search papers in the Academic Graph API.
 */
class SemanticScholarBulkSearchPapers extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_bulk_search_papers';
    protected const DESCRIPTION = 'Bulk search Semantic Scholar papers using /graph/v1/paper/search/bulk.';
    protected const PATH = 'paper/search/bulk';
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query.'],
        'token' => ['type' => 'string', 'required' => false, 'description' => 'Pagination token returned by bulk search.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
        'sort' => ['type' => 'string', 'required' => false, 'description' => 'Sort expression supported by bulk search.'],
        'publicationTypes' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Publication type filters.', 'items' => ['type' => 'string']],
        'openAccessPdf' => ['type' => 'boolean', 'required' => false, 'description' => 'Filter to papers with open-access PDFs.'],
        'minCitationCount' => ['type' => 'integer', 'required' => false, 'description' => 'Minimum citation count.'],
        'publicationDateOrYear' => ['type' => 'string', 'required' => false, 'description' => 'Publication date or year range.'],
        'year' => ['type' => 'string', 'required' => false, 'description' => 'Year or year range.'],
        'venue' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Venue filters.', 'items' => ['type' => 'string']],
        'fieldsOfStudy' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields of study filters.', 'items' => ['type' => 'string']],
    ];
}

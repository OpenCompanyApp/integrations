<?php

namespace OpenCompany\Integrations\SemanticScholar\Tools;

/**
 * Search paper text snippets.
 */
class SemanticScholarSearchSnippets extends AbstractSemanticScholarTool
{
    protected const NAME = 'semantic_scholar_search_snippets';
    protected const DESCRIPTION = 'Search Semantic Scholar text snippets using /graph/v1/snippet/search.';
    protected const PATH = 'snippet/search';
    protected const REQUIRED = ['query'];
    protected const PARAMETERS = [
        'query' => ['type' => 'string', 'required' => true, 'description' => 'Snippet search query.'],
        'fields' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return.', 'items' => ['type' => 'string']],
        'paperIds' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Restrict snippets to paper IDs.', 'items' => ['type' => 'string']],
        'authors' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Author filters.', 'items' => ['type' => 'string']],
        'minCitationCount' => ['type' => 'integer', 'required' => false, 'description' => 'Minimum citation count.'],
        'insertedBefore' => ['type' => 'string', 'required' => false, 'description' => 'Restrict by insertion date.'],
        'publicationDateOrYear' => ['type' => 'string', 'required' => false, 'description' => 'Publication date or year filter.'],
        'year' => ['type' => 'string', 'required' => false, 'description' => 'Year or year range.'],
        'venue' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Venue filters.', 'items' => ['type' => 'string']],
        'fieldsOfStudy' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields of study filters.', 'items' => ['type' => 'string']],
        'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return.'],
    ];
}

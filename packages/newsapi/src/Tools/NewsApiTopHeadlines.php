<?php

namespace OpenCompany\Integrations\NewsApi\Tools;

/**
 * Retrieve live top and breaking headlines.
 */
class NewsApiTopHeadlines extends AbstractNewsApiTool
{
    protected const NAME = 'newsapi_top_headlines';
    protected const DESCRIPTION = 'Retrieve live top and breaking headlines by country, category, source, keyword, and pagination.';
    protected const METHOD = 'topHeadlines';
    protected const PARAMETERS = [
        'country' => ['type' => 'string', 'required' => false, 'description' => 'Two-letter ISO 3166-1 country code. Cannot be mixed with sources.'],
        'category' => ['type' => 'string', 'required' => false, 'description' => 'Headline category. Cannot be mixed with sources.', 'enum' => ['business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology']],
        'sources' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated source IDs. Cannot be mixed with country or category.'],
        'q' => ['type' => 'string', 'required' => false, 'description' => 'Keywords or a phrase to search for.'],
        'page_size' => ['type' => 'integer', 'required' => false, 'description' => 'Results per page. Default is 20; maximum is 100.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for pagination.'],
    ];
}

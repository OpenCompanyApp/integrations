<?php

namespace OpenCompany\Integrations\NewsApi\Tools;

/**
 * Search across indexed news articles.
 */
class NewsApiEverything extends AbstractNewsApiTool
{
    protected const NAME = 'newsapi_everything';
    protected const DESCRIPTION = 'Search across indexed NewsAPI articles using keywords, sources, domains, dates, language, sorting, and pagination.';
    protected const METHOD = 'everything';
    protected const PARAMETERS = [
        'q' => ['type' => 'string', 'required' => false, 'description' => 'Keywords or advanced search expression. NewsAPI supports quoted phrases, +required terms, -excluded terms, and AND/OR/NOT.'],
        'search_in' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated fields to search.', 'enum' => ['title', 'description', 'content', 'title,description', 'title,content', 'description,content', 'title,description,content']],
        'sources' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated source IDs, maximum 20.'],
        'domains' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated domains to restrict results to.'],
        'exclude_domains' => ['type' => 'string', 'required' => false, 'description' => 'Comma-separated domains to exclude.'],
        'from_date' => ['type' => 'string', 'required' => false, 'description' => 'Oldest article date or datetime, mapped to NewsAPI from.'],
        'to_date' => ['type' => 'string', 'required' => false, 'description' => 'Newest article date or datetime, mapped to NewsAPI to.'],
        'language' => ['type' => 'string', 'required' => false, 'description' => 'Two-letter language code.', 'enum' => ['ar', 'de', 'en', 'es', 'fr', 'he', 'it', 'nl', 'no', 'pt', 'ru', 'sv', 'ud', 'zh']],
        'sort_by' => ['type' => 'string', 'required' => false, 'description' => 'Sort order.', 'enum' => ['relevancy', 'popularity', 'publishedAt']],
        'page_size' => ['type' => 'integer', 'required' => false, 'description' => 'Results per page. NewsAPI default is 100 for everything; maximum is 100.'],
        'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number for pagination.'],
    ];
}

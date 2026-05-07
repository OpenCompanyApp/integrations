<?php

namespace OpenCompany\Integrations\NewsApi\Tools;

/**
 * List sources available for top headlines.
 */
class NewsApiSources extends AbstractNewsApiTool
{
    protected const NAME = 'newsapi_sources';
    protected const DESCRIPTION = 'List NewsAPI sources available for top headlines, optionally filtered by category, language, or country.';
    protected const METHOD = 'sources';
    protected const PARAMETERS = [
        'category' => ['type' => 'string', 'required' => false, 'description' => 'Source category.', 'enum' => ['business', 'entertainment', 'general', 'health', 'science', 'sports', 'technology']],
        'language' => ['type' => 'string', 'required' => false, 'description' => 'Two-letter source language code.', 'enum' => ['ar', 'de', 'en', 'es', 'fr', 'he', 'it', 'nl', 'no', 'pt', 'ru', 'sv', 'ud', 'zh']],
        'country' => ['type' => 'string', 'required' => false, 'description' => 'Two-letter source country code.'],
    ];
}

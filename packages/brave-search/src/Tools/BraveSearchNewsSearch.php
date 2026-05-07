<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Search Brave's news index.
 */
class BraveSearchNewsSearch extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_news';
    protected const DESCRIPTION = 'Search Brave news results with country, language, freshness, pagination, extra snippets, goggles, and safesearch options.';
    protected const METHOD = 'newsSearch';

    public function parameters(): array
    {
        return BraveSearchParameters::news();
    }
}

<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Search Brave's web index.
 */
class BraveSearchWebSearch extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_web';
    protected const DESCRIPTION = 'Search Brave web results with locale, freshness, pagination, snippets, rich callback, summarizer, goggles, and local-aware options.';
    protected const METHOD = 'webSearch';

    public function parameters(): array
    {
        return BraveSearchParameters::web();
    }
}

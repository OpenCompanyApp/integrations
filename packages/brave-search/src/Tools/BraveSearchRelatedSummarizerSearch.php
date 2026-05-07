<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch a legacy Brave summarizer result.
 */
class BraveSearchRelatedSummarizerSearch extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_summarizer';
    protected const DESCRIPTION = 'Fetch a deprecated Brave Summarizer search result by opaque key from web search summary=1.';
    protected const METHOD = 'summarizerSearch';

    public function parameters(): array
    {
        return BraveSearchParameters::summarizer(true);
    }
}

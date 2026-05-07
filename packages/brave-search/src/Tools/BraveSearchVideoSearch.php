<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Search Brave's video index.
 */
class BraveSearchVideoSearch extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_videos';
    protected const DESCRIPTION = 'Search Brave video results with country, language, freshness, pagination, safesearch, and spellcheck options.';
    protected const METHOD = 'videoSearch';

    public function parameters(): array
    {
        return BraveSearchParameters::media(50, 'moderate');
    }
}

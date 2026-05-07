<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Search Brave's image index.
 */
class BraveSearchImageSearch extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_images';
    protected const DESCRIPTION = 'Search Brave image results with country, language, count, safesearch, freshness, and spellcheck options.';
    protected const METHOD = 'imageSearch';

    public function parameters(): array
    {
        return BraveSearchParameters::media(200);
    }
}

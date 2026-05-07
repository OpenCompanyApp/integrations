<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Search Brave's place index.
 */
class BraveSearchPlaceSearch extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_places';
    protected const DESCRIPTION = 'Search Brave places and points of interest by coordinates, location string, query, radius, locale, units, safesearch, and spellcheck.';
    protected const METHOD = 'placeSearch';

    public function parameters(): array
    {
        return BraveSearchParameters::place();
    }
}

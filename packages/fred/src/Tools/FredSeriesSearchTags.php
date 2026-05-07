<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get tags for a FRED series search.
 */
class FredSeriesSearchTags extends AbstractFredTool
{
    protected const NAME = 'fred_series_search_tags';
    protected const DESCRIPTION = 'Get tags for a FRED series search with optional tag filters.';
    protected const METHOD = 'seriesSearchTags';

    public function parameters(): array
    {
        return FredParameters::seriesSearchTags();
    }
}

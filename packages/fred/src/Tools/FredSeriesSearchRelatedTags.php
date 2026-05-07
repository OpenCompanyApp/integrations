<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get related tags for a FRED series search.
 */
class FredSeriesSearchRelatedTags extends AbstractFredTool
{
    protected const NAME = 'fred_series_search_related_tags';
    protected const DESCRIPTION = 'Get related tags for a FRED series search and required tag_names set.';
    protected const METHOD = 'seriesSearchRelatedTags';

    public function parameters(): array
    {
        return FredParameters::seriesSearchTags(true);
    }
}

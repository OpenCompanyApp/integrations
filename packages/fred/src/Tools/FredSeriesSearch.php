<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Search FRED economic data series.
 */
class FredSeriesSearch extends AbstractFredTool
{
    protected const NAME = 'fred_series_search';
    protected const DESCRIPTION = 'Search FRED economic data series by text, tags, filters, ordering, and pagination.';
    protected const METHOD = 'seriesSearch';

    public function parameters(): array
    {
        return FredParameters::seriesSearch();
    }
}

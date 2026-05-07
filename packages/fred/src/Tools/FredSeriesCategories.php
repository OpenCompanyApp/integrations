<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get categories for a FRED series.
 */
class FredSeriesCategories extends AbstractFredTool
{
    protected const NAME = 'fred_series_categories';
    protected const DESCRIPTION = 'Get categories assigned to a FRED economic data series.';
    protected const METHOD = 'seriesCategories';

    public function parameters(): array
    {
        return FredParameters::series();
    }
}

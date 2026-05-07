<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get vintage dates for a FRED series.
 */
class FredSeriesVintageDates extends AbstractFredTool
{
    protected const NAME = 'fred_series_vintagedates';
    protected const DESCRIPTION = 'Get the dates when a FRED series was revised or new data values were released.';
    protected const METHOD = 'seriesVintageDates';

    public function parameters(): array
    {
        return FredParameters::series();
    }
}

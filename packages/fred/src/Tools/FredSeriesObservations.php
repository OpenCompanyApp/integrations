<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get observations for a FRED series.
 */
class FredSeriesObservations extends AbstractFredTool
{
    protected const NAME = 'fred_series_observations';
    protected const DESCRIPTION = 'Get observations for a FRED series with date ranges, realtime windows, transformations, frequencies, aggregation, output type, and vintage dates.';
    protected const METHOD = 'seriesObservations';

    public function parameters(): array
    {
        return FredParameters::seriesObservations();
    }
}

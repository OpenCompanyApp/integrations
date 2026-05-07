<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get FRED series update records.
 */
class FredSeriesUpdates extends AbstractFredTool
{
    protected const NAME = 'fred_series_updates';
    protected const DESCRIPTION = 'Get economic data series sorted by when observations were updated on the FRED server.';
    protected const METHOD = 'seriesUpdates';

    public function parameters(): array
    {
        return FredParameters::seriesUpdates();
    }
}

<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get the release for a FRED series.
 */
class FredSeriesRelease extends AbstractFredTool
{
    protected const NAME = 'fred_series_release';
    protected const DESCRIPTION = 'Get the release metadata associated with a FRED series.';
    protected const METHOD = 'seriesRelease';

    public function parameters(): array
    {
        return FredParameters::series();
    }
}

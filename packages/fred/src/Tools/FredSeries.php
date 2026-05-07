<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get one FRED series.
 */
class FredSeries extends AbstractFredTool
{
    protected const NAME = 'fred_series';
    protected const DESCRIPTION = 'Get metadata for one FRED economic data series by series_id.';
    protected const METHOD = 'series';

    public function parameters(): array
    {
        return FredParameters::series();
    }
}

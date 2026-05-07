<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get tags for a FRED series.
 */
class FredSeriesTags extends AbstractFredTool
{
    protected const NAME = 'fred_series_tags';
    protected const DESCRIPTION = 'Get tags for a FRED series by series_id.';
    protected const METHOD = 'seriesTags';

    public function parameters(): array
    {
        return FredParameters::series();
    }
}

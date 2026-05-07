<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get FRED data sources.
 */
class FredSources extends AbstractFredTool
{
    protected const NAME = 'fred_sources';
    protected const DESCRIPTION = 'Get all sources of economic data in FRED with realtime, ordering, and pagination options.';
    protected const METHOD = 'sources';

    public function parameters(): array
    {
        return FredParameters::source(false);
    }
}

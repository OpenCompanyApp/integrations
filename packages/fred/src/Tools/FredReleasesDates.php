<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get release dates for all FRED releases.
 */
class FredReleasesDates extends AbstractFredTool
{
    protected const NAME = 'fred_releases_dates';
    protected const DESCRIPTION = 'Get release dates for all FRED releases with optional release and date filters.';
    protected const METHOD = 'releasesDates';

    public function parameters(): array
    {
        return FredParameters::releasesDates();
    }
}

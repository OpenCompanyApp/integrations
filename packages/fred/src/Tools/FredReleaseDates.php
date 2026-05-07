<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get dates for one FRED release.
 */
class FredReleaseDates extends AbstractFredTool
{
    protected const NAME = 'fred_release_dates';
    protected const DESCRIPTION = 'Get release dates for one FRED release with date, realtime, ordering, and pagination options.';
    protected const METHOD = 'releaseDates';

    public function parameters(): array
    {
        return FredParameters::releasesDates(true);
    }
}

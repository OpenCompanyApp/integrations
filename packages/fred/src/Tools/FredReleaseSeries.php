<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get series for a FRED release.
 */
class FredReleaseSeries extends AbstractFredTool
{
    protected const NAME = 'fred_release_series';
    protected const DESCRIPTION = 'Get economic data series on a FRED release with filters, ordering, and pagination.';
    protected const METHOD = 'releaseSeries';

    public function parameters(): array
    {
        return FredParameters::releaseSeries();
    }
}

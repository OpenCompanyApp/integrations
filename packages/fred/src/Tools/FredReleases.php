<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get all FRED releases.
 */
class FredReleases extends AbstractFredTool
{
    protected const NAME = 'fred_releases';
    protected const DESCRIPTION = 'Get all releases of economic data with realtime, ordering, and pagination options.';
    protected const METHOD = 'releases';

    public function parameters(): array
    {
        return FredParameters::releases();
    }
}

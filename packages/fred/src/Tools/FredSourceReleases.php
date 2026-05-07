<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get releases for a FRED source.
 */
class FredSourceReleases extends AbstractFredTool
{
    protected const NAME = 'fred_source_releases';
    protected const DESCRIPTION = 'Get releases for one FRED source by source_id.';
    protected const METHOD = 'sourceReleases';

    public function parameters(): array
    {
        return FredParameters::source();
    }
}

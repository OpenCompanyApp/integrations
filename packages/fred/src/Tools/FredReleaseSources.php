<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get sources for a FRED release.
 */
class FredReleaseSources extends AbstractFredTool
{
    protected const NAME = 'fred_release_sources';
    protected const DESCRIPTION = 'Get sources for a FRED release by release_id.';
    protected const METHOD = 'releaseSources';

    public function parameters(): array
    {
        return FredParameters::release();
    }
}

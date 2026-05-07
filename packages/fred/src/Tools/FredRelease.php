<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get one FRED release.
 */
class FredRelease extends AbstractFredTool
{
    protected const NAME = 'fred_release';
    protected const DESCRIPTION = 'Get metadata for one FRED release by release_id.';
    protected const METHOD = 'release';

    public function parameters(): array
    {
        return FredParameters::release();
    }
}

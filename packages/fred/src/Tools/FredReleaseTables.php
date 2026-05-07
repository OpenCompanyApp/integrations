<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get release tables for a FRED release.
 */
class FredReleaseTables extends AbstractFredTool
{
    protected const NAME = 'fred_release_tables';
    protected const DESCRIPTION = 'Get FRED release tables, optionally scoped to an element and observation date.';
    protected const METHOD = 'releaseTables';

    public function parameters(): array
    {
        return FredParameters::releaseTables();
    }
}

<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get tags for a FRED release.
 */
class FredReleaseTags extends AbstractFredTool
{
    protected const NAME = 'fred_release_tags';
    protected const DESCRIPTION = 'Get tags for a FRED release with optional search, grouping, ordering, and pagination.';
    protected const METHOD = 'releaseTags';

    public function parameters(): array
    {
        return FredParameters::releaseTags();
    }
}

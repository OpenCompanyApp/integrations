<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get related tags for a FRED release.
 */
class FredReleaseRelatedTags extends AbstractFredTool
{
    protected const NAME = 'fred_release_related_tags';
    protected const DESCRIPTION = 'Get related tags for a FRED release and required tag_names set.';
    protected const METHOD = 'releaseRelatedTags';

    public function parameters(): array
    {
        return FredParameters::releaseRelatedTags();
    }
}

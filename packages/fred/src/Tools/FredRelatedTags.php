<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get related FRED tags.
 */
class FredRelatedTags extends AbstractFredTool
{
    protected const NAME = 'fred_related_tags';
    protected const DESCRIPTION = 'Get related tags for one or more FRED tags.';
    protected const METHOD = 'relatedTags';

    public function parameters(): array
    {
        return FredParameters::relatedTags();
    }
}

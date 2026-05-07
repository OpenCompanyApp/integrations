<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get series matching FRED tags.
 */
class FredTagsSeries extends AbstractFredTool
{
    protected const NAME = 'fred_tags_series';
    protected const DESCRIPTION = 'Get FRED series that match a required tag_names set.';
    protected const METHOD = 'tagsSeries';

    public function parameters(): array
    {
        return FredParameters::tagsSeries();
    }
}

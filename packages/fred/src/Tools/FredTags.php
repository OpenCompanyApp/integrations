<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Search and list FRED tags.
 */
class FredTags extends AbstractFredTool
{
    protected const NAME = 'fred_tags';
    protected const DESCRIPTION = 'Get all FRED tags, search tags, or get tags by name with ordering and pagination.';
    protected const METHOD = 'tags';

    public function parameters(): array
    {
        return FredParameters::tags();
    }
}

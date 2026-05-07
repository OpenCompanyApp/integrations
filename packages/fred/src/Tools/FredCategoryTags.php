<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get tags for a FRED category.
 */
class FredCategoryTags extends AbstractFredTool
{
    protected const NAME = 'fred_category_tags';
    protected const DESCRIPTION = 'Get the tags for a FRED category with optional search, grouping, ordering, and pagination.';
    protected const METHOD = 'categoryTags';

    public function parameters(): array
    {
        return FredParameters::categoryTags();
    }
}

<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get related tags for a FRED category.
 */
class FredCategoryRelatedTags extends AbstractFredTool
{
    protected const NAME = 'fred_category_related_tags';
    protected const DESCRIPTION = 'Get related tags for a FRED category and required tag_names set.';
    protected const METHOD = 'categoryRelatedTags';

    public function parameters(): array
    {
        return FredParameters::categoryRelatedTags();
    }
}

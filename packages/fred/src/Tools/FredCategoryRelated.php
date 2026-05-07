<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get related categories for a FRED category.
 */
class FredCategoryRelated extends AbstractFredTool
{
    protected const NAME = 'fred_category_related';
    protected const DESCRIPTION = 'Get categories related to a specified FRED category.';
    protected const METHOD = 'categoryRelated';

    public function parameters(): array
    {
        return FredParameters::category(true);
    }
}

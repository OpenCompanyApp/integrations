<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get child categories for a FRED category.
 */
class FredCategoryChildren extends AbstractFredTool
{
    protected const NAME = 'fred_category_children';
    protected const DESCRIPTION = 'Get the child categories for a specified parent category.';
    protected const METHOD = 'categoryChildren';

    public function parameters(): array
    {
        return FredParameters::category();
    }
}

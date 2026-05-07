<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get a FRED category.
 */
class FredCategory extends AbstractFredTool
{
    protected const NAME = 'fred_category';
    protected const DESCRIPTION = 'Get a FRED category by category ID, or the root category when omitted.';
    protected const METHOD = 'category';

    public function parameters(): array
    {
        return FredParameters::category();
    }
}

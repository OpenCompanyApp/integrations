<?php

namespace OpenCompany\Integrations\Fred\Tools;

/**
 * Get economic data series in a FRED category.
 */
class FredCategorySeries extends AbstractFredTool
{
    protected const NAME = 'fred_category_series';
    protected const DESCRIPTION = 'Get the economic data series in a FRED category with filters, ordering, and pagination.';
    protected const METHOD = 'categorySeries';

    public function parameters(): array
    {
        return FredParameters::categorySeries();
    }
}

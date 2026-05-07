<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * List and search Census API datasets.
 */
class UsCensusListDatasets extends AbstractUsCensusTool
{
    protected const NAME = 'us_census_list_datasets';
    protected const DESCRIPTION = 'List all U.S. Census API datasets with optional search and vintage filters.';
    protected const METHOD = 'listDatasets';

    public function parameters(): array
    {
        return UsCensusParameters::discovery();
    }
}

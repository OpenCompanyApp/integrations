<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * List supported Census dataset geographies.
 */
class UsCensusGeographies extends AbstractUsCensusTool
{
    protected const NAME = 'us_census_geographies';
    protected const DESCRIPTION = 'List or search supported geographies for one Census API dataset.';
    protected const METHOD = 'geographies';

    public function parameters(): array
    {
        return UsCensusParameters::metadataList();
    }
}

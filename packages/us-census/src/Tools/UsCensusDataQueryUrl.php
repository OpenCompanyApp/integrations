<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * Build Census data query URLs.
 */
class UsCensusDataQueryUrl extends AbstractUsCensusTool
{
    protected const NAME = 'us_census_data_query_url';
    protected const DESCRIPTION = 'Build a Census data query URL for sharing, debugging, or reproducible research.';
    protected const METHOD = 'dataQueryUrl';

    public function parameters(): array
    {
        return UsCensusParameters::dataQuery(true);
    }
}

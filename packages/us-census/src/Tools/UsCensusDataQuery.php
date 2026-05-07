<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * Query Census dataset rows.
 */
class UsCensusDataQuery extends AbstractUsCensusTool
{
    protected const NAME = 'us_census_data_query';
    protected const DESCRIPTION = 'Query one Census API dataset and normalize the header row plus data rows into records.';
    protected const METHOD = 'dataQuery';

    public function parameters(): array
    {
        return UsCensusParameters::dataQuery();
    }
}

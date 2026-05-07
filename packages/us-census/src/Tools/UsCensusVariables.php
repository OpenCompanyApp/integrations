<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * List and search Census dataset variables.
 */
class UsCensusVariables extends AbstractUsCensusTool
{
    protected const NAME = 'us_census_variables';
    protected const DESCRIPTION = 'List or search variables for one Census dataset, optionally scoped to a variable group.';
    protected const METHOD = 'variables';

    public function parameters(): array
    {
        return UsCensusParameters::variables();
    }
}

<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * Get Census dataset examples.
 */
class UsCensusExamples extends AbstractUsCensusTool
{
    protected const NAME = 'us_census_examples';
    protected const DESCRIPTION = 'Get official example queries for one Census API dataset.';
    protected const METHOD = 'examples';

    public function parameters(): array
    {
        return UsCensusParameters::dataset();
    }
}

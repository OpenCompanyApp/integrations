<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * List and search Census dataset groups.
 */
class UsCensusGroups extends AbstractUsCensusTool
{
    protected const NAME = 'us_census_groups';
    protected const DESCRIPTION = 'List or search variable groups for one Census API dataset.';
    protected const METHOD = 'groups';

    public function parameters(): array
    {
        return UsCensusParameters::metadataList();
    }
}

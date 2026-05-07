<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch details for Brave local POIs.
 */
class BraveSearchLocalPois extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_local_pois';
    protected const DESCRIPTION = 'Fetch detailed POI information for ephemeral place IDs returned by Brave web or place search.';
    protected const METHOD = 'localPois';

    public function parameters(): array
    {
        return BraveSearchParameters::localPois();
    }
}

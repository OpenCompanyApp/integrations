<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch descriptions for Brave local POIs.
 */
class BraveSearchLocalDescriptions extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_local_descriptions';
    protected const DESCRIPTION = 'Fetch AI-generated descriptions for ephemeral place IDs returned by Brave web or place search.';
    protected const METHOD = 'localDescriptions';

    public function parameters(): array
    {
        return BraveSearchParameters::localDescriptions();
    }
}

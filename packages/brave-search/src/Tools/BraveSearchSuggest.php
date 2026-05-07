<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Get Brave query suggestions.
 */
class BraveSearchSuggest extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_suggest';
    protected const DESCRIPTION = 'Get Brave autosuggest query completions with optional country, count, and rich metadata.';
    protected const METHOD = 'suggest';

    public function parameters(): array
    {
        return BraveSearchParameters::suggest();
    }
}

<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Get Brave spelling corrections.
 */
class BraveSearchSpellcheck extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_spellcheck';
    protected const DESCRIPTION = 'Get Brave spellcheck corrections for a query.';
    protected const METHOD = 'spellcheck';

    public function parameters(): array
    {
        return BraveSearchParameters::spellcheck();
    }
}

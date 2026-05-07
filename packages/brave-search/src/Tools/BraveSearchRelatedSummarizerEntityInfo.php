<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch legacy Brave summarizer entity information.
 */
class BraveSearchRelatedSummarizerEntityInfo extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_summarizer_entity_info';
    protected const DESCRIPTION = 'Fetch deprecated Brave Summarizer entity information by opaque key.';
    protected const METHOD = 'summarizerEntityInfo';

    public function parameters(): array
    {
        return BraveSearchParameters::summarizer();
    }
}

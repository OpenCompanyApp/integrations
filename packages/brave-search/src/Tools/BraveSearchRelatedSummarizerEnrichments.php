<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch legacy Brave summarizer enrichments.
 */
class BraveSearchRelatedSummarizerEnrichments extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_summarizer_enrichments';
    protected const DESCRIPTION = 'Fetch deprecated Brave Summarizer enrichment data by opaque key.';
    protected const METHOD = 'summarizerEnrichments';

    public function parameters(): array
    {
        return BraveSearchParameters::summarizer();
    }
}

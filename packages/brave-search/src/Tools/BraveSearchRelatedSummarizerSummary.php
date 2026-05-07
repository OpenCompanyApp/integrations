<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch a legacy Brave summarizer summary.
 */
class BraveSearchRelatedSummarizerSummary extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_summarizer_summary';
    protected const DESCRIPTION = 'Fetch just the deprecated Brave Summarizer summary by opaque key.';
    protected const METHOD = 'summarizerSummary';

    public function parameters(): array
    {
        return BraveSearchParameters::summarizer(true);
    }
}

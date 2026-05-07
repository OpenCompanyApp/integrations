<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch legacy Brave summarizer follow-ups.
 */
class BraveSearchRelatedSummarizerFollowups extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_summarizer_followups';
    protected const DESCRIPTION = 'Fetch deprecated Brave Summarizer follow-up questions by opaque key.';
    protected const METHOD = 'summarizerFollowups';

    public function parameters(): array
    {
        return BraveSearchParameters::summarizer();
    }
}

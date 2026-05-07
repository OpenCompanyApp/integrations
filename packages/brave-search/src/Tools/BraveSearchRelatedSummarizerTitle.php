<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Fetch a legacy Brave summarizer title.
 */
class BraveSearchRelatedSummarizerTitle extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_summarizer_title';
    protected const DESCRIPTION = 'Fetch just the deprecated Brave Summarizer title by opaque key.';
    protected const METHOD = 'summarizerTitle';

    public function parameters(): array
    {
        return BraveSearchParameters::summarizer();
    }
}

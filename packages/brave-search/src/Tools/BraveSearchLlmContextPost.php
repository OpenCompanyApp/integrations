<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Retrieve LLM-ready Brave web context with POST.
 */
class BraveSearchLlmContextPost extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_llm_context_post';
    protected const DESCRIPTION = 'Retrieve Brave LLM Context grounding data using POST for larger or complex query payloads.';
    protected const METHOD = 'llmContextPost';

    public function parameters(): array
    {
        return BraveSearchParameters::llmContext();
    }
}

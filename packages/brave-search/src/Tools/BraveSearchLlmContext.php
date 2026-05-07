<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Retrieve LLM-ready Brave web context with GET.
 */
class BraveSearchLlmContext extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_llm_context';
    protected const DESCRIPTION = 'Retrieve Brave LLM Context grounding data with configurable token budgets, threshold modes, freshness, goggles, and optional location headers.';
    protected const METHOD = 'llmContext';

    public function parameters(): array
    {
        return BraveSearchParameters::llmContext();
    }
}

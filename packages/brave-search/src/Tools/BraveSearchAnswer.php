<?php

namespace OpenCompany\Integrations\BraveSearch\Tools;

/**
 * Create a Brave grounded answer.
 */
class BraveSearchAnswer extends AbstractBraveSearchTool
{
    protected const NAME = 'brave_search_answer';
    protected const DESCRIPTION = 'Create a Brave AI answer through the OpenAI-compatible chat completions endpoint. Use non-streaming for predictable tool responses.';
    protected const METHOD = 'answer';

    public function parameters(): array
    {
        return BraveSearchParameters::answer();
    }
}

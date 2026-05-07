<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Invoke Prompt.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/prompts/invoke_prompt.
 */
class LangSmithInvokePrompt extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_invoke_prompt';
    protected const DESCRIPTION = 'Invoke Prompt

Official endpoint: POST /api/v1/prompts/invoke_prompt
Invoke Prompt.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/prompts/invoke_prompt';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

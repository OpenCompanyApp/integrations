<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Prompt Canvas.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/prompts/canvas.
 */
class LangSmithPromptCanvas extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_prompt_canvas';
    protected const DESCRIPTION = 'Prompt Canvas

Official endpoint: POST /api/v1/prompts/canvas
Prompt Canvas.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/prompts/canvas';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

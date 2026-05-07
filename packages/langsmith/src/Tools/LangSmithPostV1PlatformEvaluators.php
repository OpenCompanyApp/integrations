<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create evaluator.
 *
 * Maps to the official LangSmith endpoint POST /v1/platform/evaluators.
 */
class LangSmithPostV1PlatformEvaluators extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_post_v1_platform_evaluators';
    protected const DESCRIPTION = 'Create evaluator

Official endpoint: POST /v1/platform/evaluators
Create a new LLM or code evaluator for the current workspace.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/v1/platform/evaluators';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

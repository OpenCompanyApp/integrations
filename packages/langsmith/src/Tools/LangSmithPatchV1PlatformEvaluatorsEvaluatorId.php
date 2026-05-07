<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update evaluator.
 *
 * Maps to the official LangSmith endpoint PATCH /v1/platform/evaluators/{evaluator_id}.
 */
class LangSmithPatchV1PlatformEvaluatorsEvaluatorId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_patch_v1_platform_evaluators_evaluator_id';
    protected const DESCRIPTION = 'Update evaluator

Official endpoint: PATCH /v1/platform/evaluators/{evaluator_id}
Update an existing evaluator\'s name, LLM configuration, or code configuration.';
    protected const PARAMETERS = array (
  'evaluator_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `evaluator_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/v1/platform/evaluators/{evaluator_id}';
    protected const PATH_PARAMS = array (
  0 => 'evaluator_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

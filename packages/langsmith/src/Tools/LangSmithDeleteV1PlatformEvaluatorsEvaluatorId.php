<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete evaluator.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/evaluators/{evaluator_id}.
 */
class LangSmithDeleteV1PlatformEvaluatorsEvaluatorId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_evaluators_evaluator_id';
    protected const DESCRIPTION = 'Delete evaluator

Official endpoint: DELETE /v1/platform/evaluators/{evaluator_id}
Delete an evaluator. When delete_run_rules is true, all run rules referencing this evaluator are deleted first (same tenant). Associated llm_evaluators and code_evaluators rows are removed by foreign-key cascade when the evaluator row is deleted.';
    protected const PARAMETERS = array (
  'evaluator_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `evaluator_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: delete_run_rules.',
  ),
  'delete_run_rules' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `delete_run_rules`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/evaluators/{evaluator_id}';
    protected const PATH_PARAMS = array (
  0 => 'evaluator_id',
);
    protected const QUERY_KEYS = array (
  0 => 'delete_run_rules',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

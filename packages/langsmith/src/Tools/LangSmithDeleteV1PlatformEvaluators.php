<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Bulk delete evaluators.
 *
 * Maps to the official LangSmith endpoint DELETE /v1/platform/evaluators.
 */
class LangSmithDeleteV1PlatformEvaluators extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_v1_platform_evaluators';
    protected const DESCRIPTION = 'Bulk delete evaluators

Official endpoint: DELETE /v1/platform/evaluators
Delete multiple evaluators by their IDs. Returns per-item success/failure.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: evaluator_ids, delete_run_rules.',
  ),
  'evaluator_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `evaluator_ids`.',
  ),
  'delete_run_rules' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `delete_run_rules`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/v1/platform/evaluators';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'evaluator_ids',
  1 => 'delete_run_rules',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

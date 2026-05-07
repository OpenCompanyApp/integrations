<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get evaluator.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/evaluators/{evaluator_id}.
 */
class LangSmithGetV1PlatformEvaluatorsEvaluatorId extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_evaluators_evaluator_id';
    protected const DESCRIPTION = 'Get evaluator

Official endpoint: GET /v1/platform/evaluators/{evaluator_id}
Retrieve a single evaluator by its ID.';
    protected const PARAMETERS = array (
  'evaluator_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `evaluator_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/evaluators/{evaluator_id}';
    protected const PATH_PARAMS = array (
  0 => 'evaluator_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

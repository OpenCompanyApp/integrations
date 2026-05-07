<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Validate Rule.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/runs/rules/validate.
 */
class LangSmithValidateRule extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_validate_rule';
    protected const DESCRIPTION = 'Validate Rule

Official endpoint: POST /api/v1/runs/rules/validate
Validate a rule by executing it with test data without creating a saved rule. This endpoint allows testing LLM-as-judge evaluators before saving them. It accepts a rule configuration (same as rule creation) and test data, executes the evaluator, and returns the evaluation results in the same format as batch_invoke_evaluator. Only LLM-as-judge rules (evaluators) are supported. Code evaluators are not allowed. The e...';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/runs/rules/validate';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

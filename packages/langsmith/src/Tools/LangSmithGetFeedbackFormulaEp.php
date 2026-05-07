<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Feedback Formula Ep.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/feedback/formulas/{feedback_formula_id}.
 */
class LangSmithGetFeedbackFormulaEp extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_feedback_formula_ep';
    protected const DESCRIPTION = 'Get Feedback Formula Ep

Official endpoint: GET /api/v1/feedback/formulas/{feedback_formula_id}
Get a feedback formula by id';
    protected const PARAMETERS = array (
  'feedback_formula_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feedback_formula_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/feedback/formulas/{feedback_formula_id}';
    protected const PATH_PARAMS = array (
  0 => 'feedback_formula_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

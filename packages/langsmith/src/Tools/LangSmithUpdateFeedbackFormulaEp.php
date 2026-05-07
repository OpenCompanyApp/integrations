<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Feedback Formula Ep.
 *
 * Maps to the official LangSmith endpoint PUT /api/v1/feedback/formulas/{feedback_formula_id}.
 */
class LangSmithUpdateFeedbackFormulaEp extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_feedback_formula_ep';
    protected const DESCRIPTION = 'Update Feedback Formula Ep

Official endpoint: PUT /api/v1/feedback/formulas/{feedback_formula_id}
Update a feedback formula';
    protected const PARAMETERS = array (
  'feedback_formula_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feedback_formula_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PUT';
    protected const PATH = '/api/v1/feedback/formulas/{feedback_formula_id}';
    protected const PATH_PARAMS = array (
  0 => 'feedback_formula_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

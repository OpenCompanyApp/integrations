<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Feedback Formula Endpoint.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/feedback/formulas/{feedback_formula_id}.
 */
class LangSmithDeleteFeedbackFormulaEndpoint extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_feedback_formula_endpoint';
    protected const DESCRIPTION = 'Delete Feedback Formula Endpoint

Official endpoint: DELETE /api/v1/feedback/formulas/{feedback_formula_id}
Delete a feedback formula by id';
    protected const PARAMETERS = array (
  'feedback_formula_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feedback_formula_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/feedback/formulas/{feedback_formula_id}';
    protected const PATH_PARAMS = array (
  0 => 'feedback_formula_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

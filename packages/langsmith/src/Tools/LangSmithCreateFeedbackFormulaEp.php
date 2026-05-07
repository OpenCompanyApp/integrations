<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Feedback Formula Ep.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/feedback/formulas.
 */
class LangSmithCreateFeedbackFormulaEp extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_feedback_formula_ep';
    protected const DESCRIPTION = 'Create Feedback Formula Ep

Official endpoint: POST /api/v1/feedback/formulas
Create a new feedback formula';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/feedback/formulas';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

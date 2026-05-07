<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Feedback.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/feedback.
 */
class LangSmithCreateFeedback extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_feedback';
    protected const DESCRIPTION = 'Create Feedback

Official endpoint: POST /api/v1/feedback
Create a new feedback.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/feedback';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

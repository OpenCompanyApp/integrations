<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Update Feedback.
 *
 * Maps to the official LangSmith endpoint PATCH /api/v1/feedback/{feedback_id}.
 */
class LangSmithUpdateFeedback extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_update_feedback';
    protected const DESCRIPTION = 'Update Feedback

Official endpoint: PATCH /api/v1/feedback/{feedback_id}
Replace an existing feedback entry with a new, modified entry.';
    protected const PARAMETERS = array (
  'feedback_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feedback_id`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'PATCH';
    protected const PATH = '/api/v1/feedback/{feedback_id}';
    protected const PATH_PARAMS = array (
  0 => 'feedback_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

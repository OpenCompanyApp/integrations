<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Delete Feedback.
 *
 * Maps to the official LangSmith endpoint DELETE /api/v1/feedback/{feedback_id}.
 */
class LangSmithDeleteFeedback extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_delete_feedback';
    protected const DESCRIPTION = 'Delete Feedback

Official endpoint: DELETE /api/v1/feedback/{feedback_id}
Delete a feedback.';
    protected const PARAMETERS = array (
  'feedback_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feedback_id`.',
  ),
);
    protected const METHOD = 'DELETE';
    protected const PATH = '/api/v1/feedback/{feedback_id}';
    protected const PATH_PARAMS = array (
  0 => 'feedback_id',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Feedback.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/feedback/{feedback_id}.
 */
class LangSmithReadFeedback extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_feedback';
    protected const DESCRIPTION = 'Read Feedback

Official endpoint: GET /api/v1/feedback/{feedback_id}
Get a specific feedback.';
    protected const PARAMETERS = array (
  'feedback_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `feedback_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: include_user_names.',
  ),
  'include_user_names' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_user_names`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/feedback/{feedback_id}';
    protected const PATH_PARAMS = array (
  0 => 'feedback_id',
);
    protected const QUERY_KEYS = array (
  0 => 'include_user_names',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

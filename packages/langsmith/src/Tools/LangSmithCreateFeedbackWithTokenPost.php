<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Feedback With Token Post.
 *
 * Maps to the official LangSmith endpoint POST /api/v1/feedback/tokens/{token}.
 */
class LangSmithCreateFeedbackWithTokenPost extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_feedback_with_token_post';
    protected const DESCRIPTION = 'Create Feedback With Token Post

Official endpoint: POST /api/v1/feedback/tokens/{token}
Create a new feedback with a token.';
    protected const PARAMETERS = array (
  'token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `token`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official LangSmith schema.',
  ),
);
    protected const METHOD = 'POST';
    protected const PATH = '/api/v1/feedback/tokens/{token}';
    protected const PATH_PARAMS = array (
  0 => 'token',
);
    protected const QUERY_KEYS = array (
);
    protected const BODY_REQUIRED = true;
    protected const MULTIPART = false;
}

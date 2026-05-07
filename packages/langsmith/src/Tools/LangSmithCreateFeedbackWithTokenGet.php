<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Create Feedback With Token Get.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/feedback/tokens/{token}.
 */
class LangSmithCreateFeedbackWithTokenGet extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_create_feedback_with_token_get';
    protected const DESCRIPTION = 'Create Feedback With Token Get

Official endpoint: GET /api/v1/feedback/tokens/{token}
Create a new feedback with a token.';
    protected const PARAMETERS = array (
  'token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `token`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: score, value, comment, correction.',
  ),
  'score' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `score`.',
  ),
  'value' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `value`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `comment`.',
  ),
  'correction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `correction`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/feedback/tokens/{token}';
    protected const PATH_PARAMS = array (
  0 => 'token',
);
    protected const QUERY_KEYS = array (
  0 => 'score',
  1 => 'value',
  2 => 'comment',
  3 => 'correction',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

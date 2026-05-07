<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Feedbacks.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/feedback.
 */
class LangSmithReadFeedbacks extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_feedbacks';
    protected const DESCRIPTION = 'Read Feedbacks

Official endpoint: GET /api/v1/feedback
List all Feedback by query params.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: run, key, session, source, limit, offset, user, has_comment, has_score, level, max_created_at, min_created_at, include_user_names, comparative_experiment_id.',
  ),
  'run' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `run`.',
  ),
  'key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `key`.',
  ),
  'session' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `session`.',
  ),
  'source' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `source`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `user`.',
  ),
  'has_comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `has_comment`.',
  ),
  'has_score' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `has_score`.',
  ),
  'level' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `level`.',
  ),
  'max_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `max_created_at`.',
  ),
  'min_created_at' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `min_created_at`.',
  ),
  'include_user_names' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `include_user_names`.',
  ),
  'comparative_experiment_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `comparative_experiment_id`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/feedback';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'run',
  1 => 'key',
  2 => 'session',
  3 => 'source',
  4 => 'limit',
  5 => 'offset',
  6 => 'user',
  7 => 'has_comment',
  8 => 'has_score',
  9 => 'level',
  10 => 'max_created_at',
  11 => 'min_created_at',
  12 => 'include_user_names',
  13 => 'comparative_experiment_id',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

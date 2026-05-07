<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Dataset Feedback.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/datasets/feedback.
 */
class LangSmithReadSharedDatasetFeedback extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_dataset_feedback';
    protected const DESCRIPTION = 'Read Shared Dataset Feedback

Official endpoint: GET /api/v1/public/{share_token}/datasets/feedback
Get feedback for runs in projects run over a dataset that has been shared.';
    protected const PARAMETERS = array (
  'share_token' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `share_token`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: run, key, session, source, limit, offset, user, has_comment, has_score, level.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/public/{share_token}/datasets/feedback';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
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
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

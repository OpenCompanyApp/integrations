<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Count Shared Examples.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/examples/count.
 */
class LangSmithCountSharedExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_count_shared_examples';
    protected const DESCRIPTION = 'Count Shared Examples

Official endpoint: GET /api/v1/public/{share_token}/examples/count
Count all examples by query params';
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
    'description' => 'Query string parameters. Known keys: id, as_of, metadata, filter.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `id`.',
  ),
  'as_of' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `as_of`.',
  ),
  'metadata' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `metadata`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/public/{share_token}/examples/count';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'as_of',
  2 => 'metadata',
  3 => 'filter',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

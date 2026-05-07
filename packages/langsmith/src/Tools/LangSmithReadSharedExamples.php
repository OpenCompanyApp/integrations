<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Examples.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/examples.
 */
class LangSmithReadSharedExamples extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_examples';
    protected const DESCRIPTION = 'Read Shared Examples

Official endpoint: GET /api/v1/public/{share_token}/examples
Get example by ids or the shared example if not specifed.';
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
    'description' => 'Query string parameters. Known keys: id, as_of, metadata, offset, limit, select, filter.',
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
  'offset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `offset`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'select' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `select`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `filter`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/public/{share_token}/examples';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'as_of',
  2 => 'metadata',
  3 => 'offset',
  4 => 'limit',
  5 => 'select',
  6 => 'filter',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

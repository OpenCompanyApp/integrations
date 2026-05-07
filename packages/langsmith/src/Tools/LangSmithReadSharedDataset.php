<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Dataset.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/datasets.
 */
class LangSmithReadSharedDataset extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_dataset';
    protected const DESCRIPTION = 'Read Shared Dataset

Official endpoint: GET /api/v1/public/{share_token}/datasets
Get dataset by ids or the shared dataset if not specifed.';
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
    'description' => 'Query string parameters. Known keys: offset, limit, sort_by, sort_by_desc.',
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
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by`.',
  ),
  'sort_by_desc' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by_desc`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/public/{share_token}/datasets';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
  0 => 'offset',
  1 => 'limit',
  2 => 'sort_by',
  3 => 'sort_by_desc',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

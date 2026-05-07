<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Datasets Stream.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/datasets/stream.
 */
class LangSmithReadDatasetsStream extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_datasets_stream';
    protected const DESCRIPTION = 'Read Datasets Stream

Official endpoint: GET /api/v1/datasets/stream
Stream all datasets by query params and owner as JSON patches.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: id, data_type, name, name_contains, metadata, offset, limit, sort_by, sort_by_desc, tag_value_id, exclude_corrections_datasets.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `id`.',
  ),
  'data_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `data_type`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name`.',
  ),
  'name_contains' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `name_contains`.',
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
  'tag_value_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag_value_id`.',
  ),
  'exclude_corrections_datasets' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `exclude_corrections_datasets`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datasets/stream';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'id',
  1 => 'data_type',
  2 => 'name',
  3 => 'name_contains',
  4 => 'metadata',
  5 => 'offset',
  6 => 'limit',
  7 => 'sort_by',
  8 => 'sort_by_desc',
  9 => 'tag_value_id',
  10 => 'exclude_corrections_datasets',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Dataset Versions.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/datasets/{dataset_id}/versions.
 */
class LangSmithGetDatasetVersions extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_dataset_versions';
    protected const DESCRIPTION = 'Get Dataset Versions

Official endpoint: GET /api/v1/datasets/{dataset_id}/versions
Get dataset versions.';
    protected const PARAMETERS = array (
  'dataset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `dataset_id`.',
  ),
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: search, example, limit, offset.',
  ),
  'search' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `search`.',
  ),
  'example' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `example`.',
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
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datasets/{dataset_id}/versions';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
  0 => 'search',
  1 => 'example',
  2 => 'limit',
  3 => 'offset',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

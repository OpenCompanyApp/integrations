<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Dataset Version.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/datasets/{dataset_id}/version.
 */
class LangSmithGetDatasetVersion extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_dataset_version';
    protected const DESCRIPTION = 'Get Dataset Version

Official endpoint: GET /api/v1/datasets/{dataset_id}/version
Get dataset version by as_of or exact tag.';
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
    'description' => 'Query string parameters. Known keys: as_of, tag.',
  ),
  'as_of' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `as_of`.',
  ),
  'tag' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `tag`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/datasets/{dataset_id}/version';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
  0 => 'as_of',
  1 => 'tag',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

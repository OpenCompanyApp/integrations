<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Comparative Experiments.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/datasets/{dataset_id}/comparative.
 */
class LangSmithReadComparativeExperiments extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_comparative_experiments';
    protected const DESCRIPTION = 'Read Comparative Experiments

Official endpoint: GET /api/v1/datasets/{dataset_id}/comparative
Get all comparative experiments for a given dataset.';
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
    'description' => 'Query string parameters. Known keys: name, name_contains, id, offset, limit, sort_by, sort_by_desc.',
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
  'id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `id`.',
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
    protected const PATH = '/api/v1/datasets/{dataset_id}/comparative';
    protected const PATH_PARAMS = array (
  0 => 'dataset_id',
);
    protected const QUERY_KEYS = array (
  0 => 'name',
  1 => 'name_contains',
  2 => 'id',
  3 => 'offset',
  4 => 'limit',
  5 => 'sort_by',
  6 => 'sort_by_desc',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

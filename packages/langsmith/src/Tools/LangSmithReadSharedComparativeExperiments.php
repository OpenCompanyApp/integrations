<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Read Shared Comparative Experiments.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/public/{share_token}/datasets/comparative.
 */
class LangSmithReadSharedComparativeExperiments extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_read_shared_comparative_experiments';
    protected const DESCRIPTION = 'Read Shared Comparative Experiments

Official endpoint: GET /api/v1/public/{share_token}/datasets/comparative
Get all comparative experiments for a given dataset.';
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
    'description' => 'Query string parameters. Known keys: name, name_contains, offset, limit, sort_by, sort_by_desc.',
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
    protected const PATH = '/api/v1/public/{share_token}/datasets/comparative';
    protected const PATH_PARAMS = array (
  0 => 'share_token',
);
    protected const QUERY_KEYS = array (
  0 => 'name',
  1 => 'name_contains',
  2 => 'offset',
  3 => 'limit',
  4 => 'sort_by',
  5 => 'sort_by_desc',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List fleet models with usage.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/fleet/usage/models.
 */
class LangSmithGetV1PlatformFleetUsageModels extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_fleet_usage_models';
    protected const DESCRIPTION = 'List fleet models with usage

Official endpoint: GET /v1/platform/fleet/usage/models
Returns the top models used in the workspace with aggregated cost and distinct run counts for the given time window. Defaults to sorting by cost descending; pass sort_by and sort_order to change.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: limit, start_time, end_time, sort_by, sort_order.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `limit`.',
  ),
  'start_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `start_time`.',
  ),
  'end_time' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `end_time`.',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_by`.',
  ),
  'sort_order' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `sort_order`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/v1/platform/fleet/usage/models';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'limit',
  1 => 'start_time',
  2 => 'end_time',
  3 => 'sort_by',
  4 => 'sort_order',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

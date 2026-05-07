<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * List fleet agents with usage.
 *
 * Maps to the official LangSmith endpoint GET /v1/platform/fleet/usage/agents.
 */
class LangSmithGetV1PlatformFleetUsageAgents extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_v1_platform_fleet_usage_agents';
    protected const DESCRIPTION = 'List fleet agents with usage

Official endpoint: GET /v1/platform/fleet/usage/agents
Returns the top agents in the workspace with cost data for the given time window. Defaults to sorting by cost descending; pass sort_by and sort_order to change. Data is sourced entirely from ClickHouse run metadata.';
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
    protected const PATH = '/v1/platform/fleet/usage/agents';
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

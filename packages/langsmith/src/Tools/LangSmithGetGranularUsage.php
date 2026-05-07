<?php

namespace OpenCompany\Integrations\LangSmith\Tools;

/**
 * Get Granular Usage.
 *
 * Maps to the official LangSmith endpoint GET /api/v1/orgs/current/billing/granular-usage.
 */
class LangSmithGetGranularUsage extends AbstractLangSmithTool
{
    protected const NAME = 'langsmith_get_granular_usage';
    protected const DESCRIPTION = 'Get Granular Usage

Official endpoint: GET /api/v1/orgs/current/billing/granular-usage
Get granular usage data with flexible grouping. workspace_ids filters results to the specified workspaces. Only workspaces the user has read access to will be included in the results.';
    protected const PARAMETERS = array (
  'query' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query string parameters. Known keys: start_time, end_time, workspace_ids, group_by.',
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
  'workspace_ids' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `workspace_ids`.',
  ),
  'group_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Shortcut for query parameter `group_by`.',
  ),
);
    protected const METHOD = 'GET';
    protected const PATH = '/api/v1/orgs/current/billing/granular-usage';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_KEYS = array (
  0 => 'start_time',
  1 => 'end_time',
  2 => 'workspace_ids',
  3 => 'group_by',
);
    protected const BODY_REQUIRED = false;
    protected const MULTIPART = false;
}

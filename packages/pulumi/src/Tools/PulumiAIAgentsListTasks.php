<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListTasks.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/agents/{orgName}/tasks.
 */
class PulumiAIAgentsListTasks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_agents_list_tasks';
    protected const DESCRIPTION = 'ListTasks

Official Pulumi Cloud endpoint: GET /api/preview/agents/{orgName}/tasks

Lists all agent tasks for the specified organization. Supports pagination via continuationToken with a configurable pageSize (1-1000, default 100). Returns task metadata including ID, name, status, and creation timestamp.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Token for retrieving the next page of results',
  ),
  'page_size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `pageSize` from the official Pulumi Cloud API operation. Number of results per page',
  ),
  'sort_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sortBy` from the official Pulumi Cloud API operation. Field to sort the results by. Defaults to lastEvent.',
    'enum' =>
    array (
      0 => 'lastEvent',
      1 => 'created',
      2 => 'status',
      3 => 'name',
    ),
  ),
  'sort_direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sortDirection` from the official Pulumi Cloud API operation. Direction to sort the results in. Defaults to desc.',
    'enum' =>
    array (
      0 => 'asc',
      1 => 'desc',
    ),
  ),
  'task_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `taskType` from the official Pulumi Cloud API operation. Task type to filter by',
    'enum' =>
    array (
      0 => 'sync',
      1 => 'async',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/agents/{orgName}/tasks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'pageSize' => 'page_size',
  'sortBy' => 'sort_by',
  'sortDirection' => 'sort_direction',
  'taskType' => 'task_type',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

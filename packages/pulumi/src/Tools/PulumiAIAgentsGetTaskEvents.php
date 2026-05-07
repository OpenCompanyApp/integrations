<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetTaskEvents.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/agents/{orgName}/tasks/{taskID}/events.
 */
class PulumiAIAgentsGetTaskEvents extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_agents_get_task_events';
    protected const DESCRIPTION = 'GetTaskEvents

Official Pulumi Cloud endpoint: GET /api/preview/agents/{orgName}/tasks/{taskID}/events

Retrieves the event stream for a specific agent task. Events include agent messages, tool calls, status changes, and user interactions. Supports pagination via continuationToken with a configurable pageSize (1-1000).';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'task_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `taskID` from the official Pulumi Cloud API operation. The agent task identifier',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/agents/{orgName}/tasks/{taskID}/events';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'taskID' => 'task_id',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'pageSize' => 'page_size',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

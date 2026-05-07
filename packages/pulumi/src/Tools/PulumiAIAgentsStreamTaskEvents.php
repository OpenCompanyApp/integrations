<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * StreamTaskEvents.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/agents/{orgName}/tasks/{taskID}/events/stream.
 */
class PulumiAIAgentsStreamTaskEvents extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_agents_stream_task_events';
    protected const DESCRIPTION = 'StreamTaskEvents

Official Pulumi Cloud endpoint: GET /api/preview/agents/{orgName}/tasks/{taskID}/events/stream

Streams events for a specific agent task as Server-Sent Events. Each SSE data frame contains a JSON-encoded AgentConsoleEvent. The stream delivers existing events immediately, then keeps the connection open to deliver new events in real time until the task completes.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/agents/{orgName}/tasks/{taskID}/events/stream';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'taskID' => 'task_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

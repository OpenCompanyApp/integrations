<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetTask.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/agents/{orgName}/tasks/{taskID}.
 */
class PulumiAIAgentsGetTask extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_agents_get_task';
    protected const DESCRIPTION = 'GetTask

Official Pulumi Cloud endpoint: GET /api/preview/agents/{orgName}/tasks/{taskID}

Retrieves metadata for a specific agent task, including its ID, name, status, creation timestamp, and associated entities. Returns 404 if the task does not exist.';
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
    protected const PATH = '/api/preview/agents/{orgName}/tasks/{taskID}';
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

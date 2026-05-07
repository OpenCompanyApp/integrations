<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateTask.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/preview/agents/{orgName}/tasks/{taskID}.
 */
class PulumiAIAgentsUpdateTask extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_agents_update_task';
    protected const DESCRIPTION = 'UpdateTask

Official Pulumi Cloud endpoint: PATCH /api/preview/agents/{orgName}/tasks/{taskID}

Updates the settings or metadata of an agent task. Only the user who created the task can modify it.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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

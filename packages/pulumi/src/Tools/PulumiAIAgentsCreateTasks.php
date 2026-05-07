<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateTasks.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/agents/{orgName}/tasks.
 */
class PulumiAIAgentsCreateTasks extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_agents_create_tasks';
    protected const DESCRIPTION = 'CreateTasks

Official Pulumi Cloud endpoint: POST /api/preview/agents/{orgName}/tasks

Creates a new agent task for the specified organization. The request must include a prompt (the user event message) that initiates the task. Set the \'permissionMode\' field in the request body to restrict the agent to read-only operations. Returns the created task details including task ID, name, status, and timestamp.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/agents/{orgName}/tasks';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

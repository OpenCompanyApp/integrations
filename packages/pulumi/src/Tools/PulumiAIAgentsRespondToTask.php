<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RespondToTask.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/agents/{orgName}/tasks/{taskID}.
 */
class PulumiAIAgentsRespondToTask extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_agents_respond_to_task';
    protected const DESCRIPTION = 'RespondToTask

Official Pulumi Cloud endpoint: POST /api/preview/agents/{orgName}/tasks/{taskID}

Sends a response to an ongoing agent task. Supported event types include user_message, user_confirmation, and user_cancel. Returns 409 if the task already has a pending request that has not completed.';
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
    protected const METHOD = 'post';
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

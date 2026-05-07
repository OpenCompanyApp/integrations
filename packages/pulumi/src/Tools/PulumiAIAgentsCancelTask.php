<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CancelTask.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/agents/{orgName}/tasks/{taskID}/cancel.
 */
class PulumiAIAgentsCancelTask extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_ai_agents_cancel_task';
    protected const DESCRIPTION = 'CancelTask

Official Pulumi Cloud endpoint: POST /api/preview/agents/{orgName}/tasks/{taskID}/cancel

Cancels an agent task. When force is true, immediately terminates the runtime session and resets the task to idle. This is the escalation path when a graceful cancel (via the user_cancel event in RespondToTask) is insufficient or the task is stuck. Unlike graceful cancel, force-cancel does not attempt to notify the agent runtime - it kills the session directly and resets the task state. Currently only force cancellation is supported; the force field must be set to true. Returns 409 if the session was stopped but the task status could not be reset to idle.';
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
    protected const PATH = '/api/preview/agents/{orgName}/tasks/{taskID}/cancel';
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

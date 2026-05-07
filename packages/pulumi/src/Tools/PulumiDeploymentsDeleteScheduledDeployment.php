<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteScheduledDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}.
 */
class PulumiDeploymentsDeleteScheduledDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_delete_scheduled_deployment';
    protected const DESCRIPTION = 'DeleteScheduledDeployment

Official Pulumi Cloud endpoint: DELETE /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}

Permanently deletes a scheduled deployment action from a stack. This removes the schedule configuration entirely and cannot be undone. The schedule will no longer execute any future runs. This endpoint is used for all schedule types (custom, drift detection, and TTL). To temporarily stop a schedule without deleting it, use the pause endpoint instead.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'project_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `projectName` from the official Pulumi Cloud API operation. The project name',
  ),
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'schedule_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `scheduleID` from the official Pulumi Cloud API operation. The schedule identifier',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'scheduleID' => 'schedule_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

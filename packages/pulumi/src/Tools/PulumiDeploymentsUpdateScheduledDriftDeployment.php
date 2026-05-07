<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateScheduledDriftDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/drift/schedules/{scheduleID}.
 */
class PulumiDeploymentsUpdateScheduledDriftDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_update_scheduled_drift_deployment';
    protected const DESCRIPTION = 'UpdateScheduledDriftDeployment

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/drift/schedules/{scheduleID}

Updates the configuration of an existing drift detection schedule. The request body can modify the cron expression controlling when drift detection runs and the autoRemediate flag that determines whether detected drift is automatically corrected by running an update operation. Auto-remediation requires a Business Critical subscription. Only future executions are affected; past drift detection runs are not modified.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/drift/schedules/{scheduleID}';
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

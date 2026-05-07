<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadScheduledDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}.
 */
class PulumiDeploymentsReadScheduledDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_read_scheduled_deployment';
    protected const DESCRIPTION = 'ReadScheduledDeployment

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules/{scheduleID}

Retrieves the full configuration and metadata for a specific scheduled deployment action. The response includes the schedule\'s ID, type (custom, drift, or TTL), timing configuration (cron expression or one-time timestamp), current status (active or paused), the deployment request that will be executed, and any type-specific fields such as autoRemediate for drift schedules or deleteAfterDestroy for TTL schedules.';
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
    protected const METHOD = 'get';
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

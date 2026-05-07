<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateScheduledTTLDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/ttl/schedules/{scheduleID}.
 */
class PulumiDeploymentsUpdateScheduledTTLDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_update_scheduled_ttldeployment';
    protected const DESCRIPTION = 'UpdateScheduledTTLDeployment

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/ttl/schedules/{scheduleID}

Updates the configuration of an existing TTL (time-to-live) schedule. The request body can modify the destruction timestamp (ISO 8601 format) and the deleteAfterDestroy flag that controls whether the stack is also removed from Pulumi Cloud after its resources are successfully destroyed. The timestamp field is required and must be set to a valid future date-time.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/ttl/schedules/{scheduleID}';
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

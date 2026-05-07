<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateScheduledTTLDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/ttl/schedules.
 */
class PulumiDeploymentsCreateScheduledTTLDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_create_scheduled_ttldeployment';
    protected const DESCRIPTION = 'CreateScheduledTTLDeployment

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/ttl/schedules

Creates a TTL (time-to-live) schedule for a stack using Pulumi Deployments. TTL schedules automatically destroy a stack\'s cloud resources at a specified expiration time, which is useful for temporary or ephemeral infrastructure that should be cleaned up after a defined period. The \'timestamp\' field must be an ISO 8601 formatted date-time (e.g. \'2024-12-31T00:00:00.000Z\') specifying when the destroy operation should execute. When \'deleteAfterDestroy\' is set to true, the stack itself is also removed from Pulumi Cloud after its resources have been successfully destroyed. The stack must have deployment settings configured before a TTL schedule can be created.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/ttl/schedules';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

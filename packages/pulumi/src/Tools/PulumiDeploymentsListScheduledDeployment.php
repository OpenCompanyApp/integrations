<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListScheduledDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules.
 */
class PulumiDeploymentsListScheduledDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_list_scheduled_deployment';
    protected const DESCRIPTION = 'ListScheduledDeployment

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules

Returns all scheduled deployment actions configured for a stack. The response includes all schedule types: custom deployment schedules (cron-based recurring or one-time), drift detection schedules, and TTL (time-to-live) schedules. Each schedule in the response contains its ID, type, configuration (cron expression or timestamp), current status (active or paused), and the deployment request that will be executed on each run.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules';
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

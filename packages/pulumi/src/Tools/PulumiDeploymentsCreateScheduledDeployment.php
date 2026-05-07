<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateScheduledDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules.
 */
class PulumiDeploymentsCreateScheduledDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_create_scheduled_deployment';
    protected const DESCRIPTION = 'CreateScheduledDeployment

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/schedules

Creates a custom deployment schedule for a stack using Pulumi Deployments. Custom schedules allow you to automate recurring or one-time Pulumi operations on a stack. The request must include exactly one of \'scheduleCron\' (a cron expression for recurring executions, e.g. \'0 * /4 * * *\' for every 4 hours) or \'scheduleOnce\' (an ISO 8601 timestamp for a one-time execution). The \'request\' field contains the deployment configuration that will be executed on each scheduled run, including the Pulumi operation type and any settings overrides. The stack must have deployment settings configured before a schedule can be created.';
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

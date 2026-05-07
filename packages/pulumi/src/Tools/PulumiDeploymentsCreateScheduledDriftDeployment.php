<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateScheduledDriftDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/drift/schedules.
 */
class PulumiDeploymentsCreateScheduledDriftDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_create_scheduled_drift_deployment';
    protected const DESCRIPTION = 'CreateScheduledDriftDeployment

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/drift/schedules

Creates a drift detection schedule for a stack using Pulumi Deployments. Drift detection identifies divergence between the declared infrastructure state in your Pulumi program and the actual state of resources in the cloud provider. The \'scheduleCron\' field accepts a cron expression defining when drift detection should run (e.g. \'0 * /4 * * *\' for every 4 hours). When \'autoRemediate\' is set to true, a remediation update is automatically triggered to bring resources back into alignment with the declared state whenever drift is detected. Auto-remediation requires a Business Critical subscription. The stack must have deployment settings configured before a drift schedule can be created.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/drift/schedules';
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

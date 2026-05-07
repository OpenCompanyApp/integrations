<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}.
 */
class PulumiDeploymentsGetDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_deployment';
    protected const DESCRIPTION = 'GetDeployment

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}

Retrieves detailed information about a specific Pulumi Deployments execution by its deployment ID. The response includes the deployment\'s current status, creation and modification timestamps, version number, the user who requested the deployment, the Pulumi operation type (update, preview, refresh, or destroy), and detailed job information. Each job contains an array of steps with their individual statuses (not-started, running, succeeded, or failed), start times, and last update timestamps. The response also includes any associated stack update results with update IDs, versions, start/end times, and result status.';
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
  'deployment_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `deploymentId` from the official Pulumi Cloud API operation. The deployment identifier',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'deploymentId' => 'deployment_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDeploymentUpdates.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/updates.
 */
class PulumiDeploymentsGetDeploymentUpdates extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_deployment_updates';
    protected const DESCRIPTION = 'GetDeploymentUpdates

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/updates

Retrieves all stack updates (program updates) associated with a specific Pulumi Deployments execution. A single deployment may produce one or more stack updates depending on the operation performed. Each update in the response includes details such as the update ID, version, start and end times, result status, and resource changes. This is useful for correlating deployment executions with their resulting infrastructure changes.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/updates';
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

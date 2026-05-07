<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CancelDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/cancel.
 */
class PulumiDeploymentsCancelDeployment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_cancel_deployment';
    protected const DESCRIPTION = 'CancelDeployment

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/cancel

Terminates an in-progress Pulumi Deployments execution for a specific stack. If the deployment is currently running, it is stopped immediately. If the deployment is queued but has not yet started, it is removed from the queue. **Warning:** Canceling a deployment is a dangerous action and may leave the stack in an inconsistent state if the deployment is canceled during the execution of a Pulumi operation. Note that this serves two endpoints: - /{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/cancel - /admin/deployments/{deploymentId}/cancel The former requires that the requesting user has stack deployment create permissions. The latter requires that the requesting user is a site administrator.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/{deploymentId}/cancel';
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

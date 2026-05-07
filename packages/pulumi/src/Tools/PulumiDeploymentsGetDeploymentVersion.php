<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDeployment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/version/{version}.
 */
class PulumiDeploymentsGetDeploymentVersion extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_deployment_version';
    protected const DESCRIPTION = 'GetDeployment

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/version/{version}

Retrieves detailed information about a specific Pulumi Deployments execution by its version number within the stack. This is an alternative to fetching by deployment ID and returns the same response structure: deployment status, creation and modification timestamps, the user who requested the deployment, the Pulumi operation type, job details with step-level progress, and any associated stack update results.';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. The deployment version number',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/version/{version}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

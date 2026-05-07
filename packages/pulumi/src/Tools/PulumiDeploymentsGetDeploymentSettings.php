<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetDeploymentSettings.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings.
 */
class PulumiDeploymentsGetDeploymentSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_get_deployment_settings';
    protected const DESCRIPTION = 'GetDeploymentSettings

Official Pulumi Cloud endpoint: GET /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings

Retrieves the Pulumi Deployments configuration for a specified stack. The response includes all saved deployment settings: source context (git repository URL, branch, and directory), operation context (environment variables, pre-run commands, OIDC provider configuration), executor context (deployment executor configuration), GitHub integration settings (repository, paths, deployment triggers), and cache options for dependency caching between runs. These settings serve as the baseline configuration for deployments when inheritSettings is true on a deployment request. Returns 404 if the stack has no deployment settings configured.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings';
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

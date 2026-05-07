<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReplaceDeploymentSettings.
 *
 * Maps to the official Pulumi Cloud endpoint put /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings.
 */
class PulumiDeploymentsReplaceDeploymentSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_replace_deployment_settings';
    protected const DESCRIPTION = 'ReplaceDeploymentSettings

Official Pulumi Cloud endpoint: PUT /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings

Fully replaces the Pulumi Deployments settings for a stack. Unlike the PATCH endpoint (PatchDeploymentSettings) which merges changes, this endpoint replaces all settings with the provided values. Any previously configured settings not included in the request body will be removed. Settings include source context (git repository URL, branch, directory), operation context (environment variables, pre-run commands, OIDC configuration), executor context, GitHub integration settings, and cache options. Requires a Team Growth or higher subscription. Cannot be used to configure Pulumi Deployments for Terraform stacks.';
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
    protected const METHOD = 'put';
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

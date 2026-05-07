<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PatchDeploymentSettings.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings.
 */
class PulumiDeploymentsPatchDeploymentSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_patch_deployment_settings';
    protected const DESCRIPTION = 'PatchDeploymentSettings

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings

Creates or updates Pulumi Deployments settings for a stack using a merge operation. If no settings exist, they are created. If settings already exist, the request body is merged with the current settings using the following logic: for each property, start with the current value, remove it if the patch specifies null, or merge the new non-null value with the existing one. Non-object properties (strings, numbers, booleans) are replaced entirely. Settings include source context (git repository URL, branch, directory), operation context (environment variables, pre-run commands, OIDC configuration), executor context, GitHub integration settings, and cache options. Requires a Team Growth or higher subscription. Cannot be used to configure Pulumi Deployments for Terraform stacks.';
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

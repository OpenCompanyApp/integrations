<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ClearProjectCache.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/stacks/{orgName}/{projectName}/{stackName}/deployments/cache.
 */
class PulumiDeploymentsClearProjectCache extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_clear_project_cache';
    protected const DESCRIPTION = 'ClearProjectCache

Official Pulumi Cloud endpoint: DELETE /api/stacks/{orgName}/{projectName}/{stackName}/deployments/cache

Clears all cached dependency and build artifacts associated with the project for Pulumi Deployments. The deployment cache stores dependencies and other artifacts between deployment runs to speed up execution. Use this endpoint to force a clean build on the next deployment, for example when cached dependencies become stale or corrupted.';
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
    protected const METHOD = 'delete';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/deployments/cache';
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

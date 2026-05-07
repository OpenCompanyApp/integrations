<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteDeploymentSettings.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings.
 */
class PulumiDeploymentsDeleteDeploymentSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_deployments_delete_deployment_settings';
    protected const DESCRIPTION = 'DeleteDeploymentSettings

Official Pulumi Cloud endpoint: DELETE /api/stacks/{orgName}/{projectName}/{stackName}/deployments/settings

Removes all Pulumi Deployments settings for a stack, including source context, operation context, executor context, GitHub integration settings, and cache options. After deletion, the stack can no longer run deployments until new settings are configured. Any active schedules (drift detection, TTL, or custom) associated with the stack may also be affected.';
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

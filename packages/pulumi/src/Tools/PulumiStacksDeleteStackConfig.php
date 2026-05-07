<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteStackConfig.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/stacks/{orgName}/{projectName}/{stackName}/config.
 */
class PulumiStacksDeleteStackConfig extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_delete_stack_config';
    protected const DESCRIPTION = 'DeleteStackConfig

Official Pulumi Cloud endpoint: DELETE /api/stacks/{orgName}/{projectName}/{stackName}/config

Removes the service-managed configuration for a stack, including the secrets provider settings, encrypted key, encryption salt, and ESC environment reference. If stack configuration is returned by the API, it is used in place of the local stack config file (e.g. Pulumi.[stack].yaml). Deleting the config causes the CLI to fall back to the local config file. Returns 204 with no content on success.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/config';
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

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/esc/environments/{orgName}/{projectName}/{envName}.
 */
class PulumiEnvironmentsDeleteEnvironmentEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_delete_environment_esc_environments';
    protected const DESCRIPTION = 'DeleteEnvironment

Official Pulumi Cloud endpoint: DELETE /api/esc/environments/{orgName}/{projectName}/{envName}

Permanently deletes a Pulumi ESC environment and all of its revision history, tags, and associated configuration. This operation is blocked if deletion protection is enabled on the environment (see PatchEnvironmentSettings). Enterprise and Business Critical edition organizations may be able to restore deleted environments within a retention window. Returns 409 if the environment is deletion-protected or has been modified since it was last read.';
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
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

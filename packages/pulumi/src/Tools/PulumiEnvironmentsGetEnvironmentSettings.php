<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetEnvironmentSettings.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/settings.
 */
class PulumiEnvironmentsGetEnvironmentSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_get_environment_settings';
    protected const DESCRIPTION = 'GetEnvironmentSettings

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/settings

Returns the current settings for a Pulumi ESC environment, including whether deletion protection is enabled. Deletion protection prevents the environment from being deleted until the setting is explicitly disabled. Settings can be modified via the PatchEnvironmentSettings endpoint.';
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
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/settings';
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

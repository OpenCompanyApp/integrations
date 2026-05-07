<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * PatchEnvironmentSettings.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/esc/environments/{orgName}/{projectName}/{envName}/settings.
 */
class PulumiEnvironmentsPatchEnvironmentSettings extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_patch_environment_settings';
    protected const DESCRIPTION = 'PatchEnvironmentSettings

Official Pulumi Cloud endpoint: PATCH /api/esc/environments/{orgName}/{projectName}/{envName}/settings

Updates settings for a Pulumi ESC environment using a partial update (patch) approach. Currently supports toggling deletion protection via the deletionProtected field. When deletionProtected is set to true, the environment cannot be deleted until the setting is explicitly disabled. Only the fields included in the request body are modified; omitted fields retain their current values.';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
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

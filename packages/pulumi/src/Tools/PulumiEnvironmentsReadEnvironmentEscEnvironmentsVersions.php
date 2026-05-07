<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}.
 */
class PulumiEnvironmentsReadEnvironmentEscEnvironmentsVersions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_read_environment_esc_environments_versions';
    protected const DESCRIPTION = 'ReadEnvironment

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}

Returns the YAML definition of a Pulumi ESC environment. The response is in application/x-yaml format and includes the environment\'s imports, values, provider configurations, and function invocations. Secrets remain in their encrypted form (use DecryptEnvironment to see plaintext secrets, or OpenEnvironment to fully resolve all dynamic values). When a version path parameter is provided, returns the definition for that specific revision.';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. The revision version number',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

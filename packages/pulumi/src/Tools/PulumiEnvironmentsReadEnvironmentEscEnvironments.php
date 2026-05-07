<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReadEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}.
 */
class PulumiEnvironmentsReadEnvironmentEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_read_environment_esc_environments';
    protected const DESCRIPTION = 'ReadEnvironment

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}

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
);
    protected const METHOD = 'get';
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

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * OpenEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/open.
 */
class PulumiEnvironmentsOpenEnvironmentEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_open_environment_esc_environments';
    protected const DESCRIPTION = 'OpenEnvironment

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/open

Opens a Pulumi ESC environment, fully resolving all dynamic values, provider integrations (fn::open), interpolation expressions, and secrets. This initiates an access session that evaluates the complete environment definition including all imports. The duration parameter specifies how long the session remains valid using Go duration format (e.g., \'2h45m\', \'300ms\'). Returns an OpenEnvironmentResponse containing the session ID and any diagnostics. Use the session ID with ReadOpenEnvironment to retrieve the resolved values.';
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
  'duration' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `duration` from the official Pulumi Cloud API operation. The session duration, using Go time units: ns, us, ms, s, m, h (e.g. \'2h\')',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/open';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
  'duration' => 'duration',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

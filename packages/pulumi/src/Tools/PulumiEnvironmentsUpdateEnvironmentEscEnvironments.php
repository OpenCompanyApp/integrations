<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/esc/environments/{orgName}/{projectName}/{envName}.
 */
class PulumiEnvironmentsUpdateEnvironmentEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_update_environment_esc_environments';
    protected const DESCRIPTION = 'UpdateEnvironment

Official Pulumi Cloud endpoint: PATCH /api/esc/environments/{orgName}/{projectName}/{envName}

Validates and updates the YAML definition of a Pulumi ESC environment. The request body must contain the complete environment definition in application/x-yaml format, including imports, values, provider configurations, and function invocations. Each successful update creates a new immutable revision in the environment\'s version history. Supports optimistic concurrency control via ETag/If-Match headers; returns 409 if the environment has been modified since it was last read.';
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

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CheckEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/check.
 */
class PulumiEnvironmentsCheckEnvironmentEscEnvironmentsVersions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_check_environment_esc_environments_versions';
    protected const DESCRIPTION = 'CheckEnvironment

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/check

Checks a Pulumi ESC environment definition for errors without applying changes. This validates the YAML definition including imports, provider configurations, function invocations (fn::open, fn::secret, etc.), and interpolation expressions. When the showSecrets query parameter is set to true, secret values are returned in plaintext in the response. The response includes any diagnostics or validation errors found in the environment definition. Supports optimistic concurrency control via ETag headers.';
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
  'show_secrets' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `showSecrets` from the official Pulumi Cloud API operation. Whether to show secret values in plaintext',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/check';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
  'showSecrets' => 'show_secrets',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

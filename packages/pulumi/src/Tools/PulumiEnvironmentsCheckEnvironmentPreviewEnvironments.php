<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CheckEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/preview/environments/{orgName}/{envName}/check.
 */
class PulumiEnvironmentsCheckEnvironmentPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_check_environment_preview_environments';
    protected const DESCRIPTION = 'CheckEnvironment

Official Pulumi Cloud endpoint: POST /api/preview/environments/{orgName}/{envName}/check

Checks a Pulumi ESC environment definition for errors without applying changes. This validates the YAML definition including imports, provider configurations, function invocations (fn::open, fn::secret, etc.), and interpolation expressions. When the showSecrets query parameter is set to true, secret values are returned in plaintext in the response. The response includes any diagnostics or validation errors found in the environment definition. Supports optimistic concurrency control via ETag headers.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'env_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `envName` from the official Pulumi Cloud API operation. The environment name',
  ),
  'show_secrets' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `showSecrets` from the official Pulumi Cloud API operation. Whether to show secret values in plaintext',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/check';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
  'showSecrets' => 'show_secrets',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

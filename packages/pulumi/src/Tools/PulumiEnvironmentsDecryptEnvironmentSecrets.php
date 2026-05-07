<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DecryptEnvironmentSecrets.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/decrypt-secrets.
 */
class PulumiEnvironmentsDecryptEnvironmentSecrets extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_decrypt_environment_secrets';
    protected const DESCRIPTION = 'DecryptEnvironmentSecrets

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/decrypt-secrets

Decrypts encrypted secret values in a Pulumi ESC environment definition. Takes an environment definition containing encrypted secrets and returns the same definition with those values decrypted to plaintext. This is useful for inspecting or migrating environment definitions that contain fn::secret values. Requires environment open permission. Returns 413 if the request content exceeds the maximum allowed size.';
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
    protected const METHOD = 'post';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/decrypt-secrets';
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

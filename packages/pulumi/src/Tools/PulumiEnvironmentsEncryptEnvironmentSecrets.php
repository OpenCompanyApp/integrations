<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * EncryptEnvironmentSecrets.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/encrypt-secrets.
 */
class PulumiEnvironmentsEncryptEnvironmentSecrets extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_encrypt_environment_secrets';
    protected const DESCRIPTION = 'EncryptEnvironmentSecrets

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/encrypt-secrets

Encrypts plaintext secret values in a Pulumi ESC environment definition. Takes an environment definition containing plaintext secrets and returns the same definition with those values encrypted using the environment\'s encryption key. This is useful for preparing environment definitions that contain sensitive values before storing or updating them. Returns 413 if the request content exceeds the maximum allowed size.';
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/encrypt-secrets';
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

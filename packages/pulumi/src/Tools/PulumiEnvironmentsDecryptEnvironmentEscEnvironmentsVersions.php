<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DecryptEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/decrypt.
 */
class PulumiEnvironmentsDecryptEnvironmentEscEnvironmentsVersions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_decrypt_environment_esc_environments_versions';
    protected const DESCRIPTION = 'DecryptEnvironment

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/decrypt

Reads the YAML definition for a Pulumi ESC environment with all static secrets decrypted and shown in plaintext. Unlike the standard ReadEnvironment endpoint which returns secrets in their encrypted form, this endpoint resolves fn::secret values to their plaintext representations. The response is returned in application/x-yaml format. This does not resolve dynamic provider values (fn::open); use OpenEnvironment for full resolution. Requires environment open permission.';
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/decrypt';
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

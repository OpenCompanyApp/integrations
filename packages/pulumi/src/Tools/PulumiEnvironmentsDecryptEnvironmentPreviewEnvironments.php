<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DecryptEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/{envName}/decrypt.
 */
class PulumiEnvironmentsDecryptEnvironmentPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_decrypt_environment_preview_environments';
    protected const DESCRIPTION = 'DecryptEnvironment

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/{envName}/decrypt

Reads the YAML definition for a Pulumi ESC environment with all static secrets decrypted and shown in plaintext. Unlike the standard ReadEnvironment endpoint which returns secrets in their encrypted form, this endpoint resolves fn::secret values to their plaintext representations. The response is returned in application/x-yaml format. This does not resolve dynamic provider values (fn::open); use OpenEnvironment for full resolution. Requires environment open permission.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/decrypt';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

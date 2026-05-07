<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * LogOnlyDecryptValue.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/decrypt/log-decryption.
 */
class PulumiStacksLogOnlyDecryptValue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_log_only_decrypt_value';
    protected const DESCRIPTION = 'LogOnlyDecryptValue

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/decrypt/log-decryption

Records an audit log entry for a single-value decryption event performed by a third-party secrets provider. When stacks use external secrets providers (such as AWS KMS, Azure Key Vault, or HashiCorp Vault), decryption happens client-side; this endpoint allows the CLI to report that decryption occurred for audit tracking.';
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
  'stack_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `stackName` from the official Pulumi Cloud API operation. The stack name',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/decrypt/log-decryption';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'stackName' => 'stack_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

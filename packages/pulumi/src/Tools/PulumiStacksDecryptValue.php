<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DecryptValue.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/decrypt.
 */
class PulumiStacksDecryptValue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_decrypt_value';
    protected const DESCRIPTION = 'DecryptValue

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/decrypt

Decrypts a single secret value using the stack\'s encryption key. The request body contains the base64-encoded ciphertext. The response contains the decrypted plaintext value. For decrypting multiple values in a single request, use the BatchDecryptValue endpoint instead. Returns 413 if the request body exceeds the maximum allowed content size.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/decrypt';
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

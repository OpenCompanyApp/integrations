<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * BatchDecryptValue.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/batch-decrypt.
 */
class PulumiStacksBatchDecryptValue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_batch_decrypt_value';
    protected const DESCRIPTION = 'BatchDecryptValue

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/batch-decrypt

Decrypts a set of secret values in a single request using the stack\'s encryption key. The request body contains an array of base64-encoded ciphertexts. The response maps each ciphertext to its decrypted plaintext value. This is a more efficient alternative to calling the single-value decrypt endpoint multiple times. Returns 400 if the request body is invalid or if message authentication fails. Returns 413 if the request body exceeds the maximum allowed content size.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/batch-decrypt';
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

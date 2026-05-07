<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * EncryptValue.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/encrypt.
 */
class PulumiStacksEncryptValue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_encrypt_value';
    protected const DESCRIPTION = 'EncryptValue

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/encrypt

Encrypts a single plaintext value using the stack\'s encryption key. The request body contains the plaintext value to encrypt. The response contains the base64-encoded ciphertext. For encrypting multiple values in a single request, use the BatchEncryptValue endpoint instead. Returns 413 if the request body exceeds the maximum allowed content size.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/encrypt';
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

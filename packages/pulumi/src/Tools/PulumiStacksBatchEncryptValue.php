<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * BatchEncryptValue.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}/{stackName}/batch-encrypt.
 */
class PulumiStacksBatchEncryptValue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_stacks_batch_encrypt_value';
    protected const DESCRIPTION = 'BatchEncryptValue

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}/{stackName}/batch-encrypt

Encrypts a set of plaintext values in a single request using the stack\'s encryption key. This is a more efficient alternative to calling the single-value encrypt endpoint multiple times. The response contains a map of the original plaintext values to their corresponding base64-encoded ciphertexts. Returns 413 if the request body exceeds the maximum allowed content size.';
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
    protected const PATH = '/api/stacks/{orgName}/{projectName}/{stackName}/batch-encrypt';
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

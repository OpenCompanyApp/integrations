<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateStack.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/stacks/{orgName}/{projectName}.
 */
class PulumiOrganizationsCreateStack extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_create_stack';
    protected const DESCRIPTION = 'CreateStack

Official Pulumi Cloud endpoint: POST /api/stacks/{orgName}/{projectName}

Creates a new stack within a project in the organization. If the project does not exist, it will be created. A stack is an isolated, independently configurable instance of a Pulumi program, typically representing a deployment environment (e.g., development, staging, production). The stack name must be unique within the project. The optional `config` object supports: - `environment`: reference to an ESC environment for storing stack configuration (must not already exist) - `secretsProvider`: the secrets provider for the stack - `encryptedKey`: KMS-encrypted ciphertext for the data key (cloud-based secrets providers only) - `encryptionSalt`: base64-encoded encryption salt (passphrase-based secrets providers only)';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/api/stacks/{orgName}/{projectName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

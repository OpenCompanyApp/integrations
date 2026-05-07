<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * EncryptProjectValue.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/projects/{orgName}/{projectName}/encrypt.
 */
class PulumiOrganizationsEncryptProjectValue extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_encrypt_project_value';
    protected const DESCRIPTION = 'EncryptProjectValue

Official Pulumi Cloud endpoint: POST /api/projects/{orgName}/{projectName}/encrypt

EncryptProjectValue encrypts a value using the project\'s key. The request body contains the base64 encoded value to be encrypted.';
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
    protected const PATH = '/api/projects/{orgName}/{projectName}/encrypt';
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

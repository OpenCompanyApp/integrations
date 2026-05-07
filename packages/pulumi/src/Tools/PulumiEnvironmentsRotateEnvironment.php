<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * RotateEnvironment.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/rotate.
 */
class PulumiEnvironmentsRotateEnvironment extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_rotate_environment';
    protected const DESCRIPTION = 'RotateEnvironment

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/rotate

Triggers secret rotation for a Pulumi ESC environment. This evaluates all fn::rotate declarations in the environment definition and rotates the corresponding secrets in their external systems (e.g., rotating database passwords, API keys, or cloud credentials). Requires the secret rotation feature to be enabled for the organization. Returns 409 if the environment has been modified since it was last read.';
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/rotate';
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

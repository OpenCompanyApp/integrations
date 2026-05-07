<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateOpenEnvironmentRequest.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/open/request.
 */
class PulumiEnvironmentsCreateOpenEnvironmentRequest extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_create_open_environment_request';
    protected const DESCRIPTION = 'CreateOpenEnvironmentRequest

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/open/request

Creates an open request for a Pulumi ESC environment that has gated opens enabled. When an environment has open gates configured, opening the environment requires an approval workflow. This endpoint initiates that process by creating an open request, and also creates corresponding open requests for each imported environment that has open gates. Requires the Approvals feature to be enabled for the organization. Returns 400 if the environment does not have gated opens.';
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/open/request';
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

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ReassignEnvironmentOwnership.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/ownership.
 */
class PulumiEnvironmentsReassignEnvironmentOwnership extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_reassign_environment_ownership';
    protected const DESCRIPTION = 'ReassignEnvironmentOwnership

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/ownership

Changes the ownership of the specified environment to the provided user. Returns the identity of the previous owner.';
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/ownership';
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

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * CreateEnvironmentTag.
 *
 * Maps to the official Pulumi Cloud endpoint post /api/esc/environments/{orgName}/{projectName}/{envName}/tags.
 */
class PulumiEnvironmentsCreateEnvironmentTagEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_create_environment_tag_esc_environments';
    protected const DESCRIPTION = 'CreateEnvironmentTag

Official Pulumi Cloud endpoint: POST /api/esc/environments/{orgName}/{projectName}/{envName}/tags

Adds a new user-defined tag to a Pulumi ESC environment. Tags are key-value pairs that provide contextual metadata for organizing and searching environments (e.g., region=us-east-1, team=platform). The tag name and value are provided in the request body. Returns the created EnvironmentTag on success. Returns 409 if a tag with the same name already exists on the environment.';
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/tags';
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

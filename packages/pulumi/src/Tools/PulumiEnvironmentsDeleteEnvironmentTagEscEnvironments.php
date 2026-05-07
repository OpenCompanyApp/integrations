<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * DeleteEnvironmentTag.
 *
 * Maps to the official Pulumi Cloud endpoint delete /api/esc/environments/{orgName}/{projectName}/{envName}/tags/{tagName}.
 */
class PulumiEnvironmentsDeleteEnvironmentTagEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_delete_environment_tag_esc_environments';
    protected const DESCRIPTION = 'DeleteEnvironmentTag

Official Pulumi Cloud endpoint: DELETE /api/esc/environments/{orgName}/{projectName}/{envName}/tags/{tagName}

Removes a user-defined tag from a Pulumi ESC environment. The tag is identified by its name in the URL path. Returns 204 on success with no response body. Returns 404 if the tag does not exist on the environment.';
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
  'tag_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tagName` from the official Pulumi Cloud API operation. The environment tag name',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/tags/{tagName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'tagName' => 'tag_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

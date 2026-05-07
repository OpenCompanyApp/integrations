<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * UpdateEnvironmentTag.
 *
 * Maps to the official Pulumi Cloud endpoint patch /api/preview/environments/{orgName}/{envName}/tags/{tagName}.
 */
class PulumiEnvironmentsUpdateEnvironmentTagPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_update_environment_tag_preview_environments';
    protected const DESCRIPTION = 'UpdateEnvironmentTag

Official Pulumi Cloud endpoint: PATCH /api/preview/environments/{orgName}/{envName}/tags/{tagName}

Modifies the value of an existing user-defined tag on a Pulumi ESC environment. The tag is identified by its name in the URL path. The request body contains the new value for the tag. Returns the updated EnvironmentTag on success. Returns 404 if the tag does not exist on the environment.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Pulumi Cloud API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/tags/{tagName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
  'tagName' => 'tag_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

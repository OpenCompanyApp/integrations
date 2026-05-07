<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetEnvironmentTag.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/{envName}/tags/{tagName}.
 */
class PulumiEnvironmentsGetEnvironmentTagPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_get_environment_tag_preview_environments';
    protected const DESCRIPTION = 'GetEnvironmentTag

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/{envName}/tags/{tagName}

Returns a single user-defined tag for a Pulumi ESC environment, identified by the tag name in the URL path. The response includes the tag name, value, and metadata. Returns 404 if the tag does not exist on the environment.';
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
);
    protected const METHOD = 'get';
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

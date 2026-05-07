<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListEnvironmentTags.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/preview/environments/{orgName}/{envName}/tags.
 */
class PulumiEnvironmentsListEnvironmentTagsPreviewEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_environment_tags_preview_environments';
    protected const DESCRIPTION = 'ListEnvironmentTags

Official Pulumi Cloud endpoint: GET /api/preview/environments/{orgName}/{envName}/tags

Returns a paginated list of user-defined tags for a Pulumi ESC environment. Tags are key-value pairs used for organizing and categorizing environments. Use the after parameter for cursor-based pagination and count to limit the number of results returned.';
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
  'after' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `after` from the official Pulumi Cloud API operation. Only return results after this value',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `count` from the official Pulumi Cloud API operation. Maximum number of results to return',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/preview/environments/{orgName}/{envName}/tags';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
  'after' => 'after',
  'count' => 'count',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

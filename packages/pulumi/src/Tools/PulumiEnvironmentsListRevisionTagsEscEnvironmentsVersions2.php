<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListRevisionTags.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/tags.
 */
class PulumiEnvironmentsListRevisionTagsEscEnvironmentsVersions2 extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_revision_tags_esc_environments_versions2';
    protected const DESCRIPTION = 'ListRevisionTags

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/tags

Returns a paginated list of revision tags for a Pulumi ESC environment. Revision tags are named references pointing to specific revision numbers (e.g., \'latest\', \'prod\', \'stable\'). They can be used in environment imports and Pulumi stack configuration to pin to a specific version. Use the after parameter for cursor-based pagination and count to limit results.';
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
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `version` from the official Pulumi Cloud API operation. The revision version number',
  ),
  'after' =>
  array (
    'type' => 'string',
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
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/tags';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
  'after' => 'after',
  'count' => 'count',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

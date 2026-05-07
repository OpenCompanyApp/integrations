<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListEnvironmentRevisions.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/versions.
 */
class PulumiEnvironmentsListEnvironmentRevisionsEscEnvironments extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_environment_revisions_esc_environments';
    protected const DESCRIPTION = 'ListEnvironmentRevisions

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/versions

Returns a paginated list of revisions for a Pulumi ESC environment. Each revision represents an immutable snapshot of the environment definition created when the environment is updated. The response includes revision numbers, timestamps, and the identity of the user who made each change. Use the before parameter to fetch revisions before a specific revision number, and count to limit the number of results returned.';
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
  'before' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `before` from the official Pulumi Cloud API operation. Only return results before this revision',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `count` from the official Pulumi Cloud API operation. Maximum number of results to return',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/versions';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
);
    protected const QUERY_PARAMS = array (
  'before' => 'before',
  'count' => 'count',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

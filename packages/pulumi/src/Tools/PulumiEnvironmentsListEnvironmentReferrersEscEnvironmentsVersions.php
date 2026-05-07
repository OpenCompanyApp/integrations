<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListEnvironmentReferrers.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/referrers.
 */
class PulumiEnvironmentsListEnvironmentReferrersEscEnvironmentsVersions extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_environment_referrers_esc_environments_versions';
    protected const DESCRIPTION = 'ListEnvironmentReferrers

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/referrers

Returns a paginated list of entities that reference a Pulumi ESC environment, including other environments that import it and Pulumi stacks that use it in their configuration. The count parameter limits results (range 1-500). Set allRevisions to true to include references across all revisions, and latestStackVersionOnly to true to return only the latest stack version for each referring stack. Use continuationToken for pagination.';
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
  'all_revisions' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `allRevisions` from the official Pulumi Cloud API operation. Whether to include all revisions',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
  'count' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `count` from the official Pulumi Cloud API operation. Maximum number of results to return',
  ),
  'latest_stack_version_only' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `latestStackVersionOnly` from the official Pulumi Cloud API operation. Whether to return only the latest stack version',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}/{projectName}/{envName}/versions/{version}/referrers';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
  'projectName' => 'project_name',
  'envName' => 'env_name',
  'version' => 'version',
);
    protected const QUERY_PARAMS = array (
  'allRevisions' => 'all_revisions',
  'continuationToken' => 'continuation_token',
  'count' => 'count',
  'latestStackVersionOnly' => 'latest_stack_version_only',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

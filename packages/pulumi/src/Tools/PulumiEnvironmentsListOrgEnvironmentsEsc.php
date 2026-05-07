<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ListOrgEnvironments.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/esc/environments/{orgName}.
 */
class PulumiEnvironmentsListOrgEnvironmentsEsc extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_environments_list_org_environments_esc';
    protected const DESCRIPTION = 'ListOrgEnvironments

Official Pulumi Cloud endpoint: GET /api/esc/environments/{orgName}

Returns a paginated list of all Pulumi ESC environments within a specific organization. Each entry includes the project, environment name, and creation/modification timestamps. Results are scoped to the organization specified in the URL path. Use continuationToken for pagination through large result sets.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'continuation_token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `continuationToken` from the official Pulumi Cloud API operation. Continuation token for paginated results',
  ),
  'include_referrer_metadata' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `includeReferrerMetadata` from the official Pulumi Cloud API operation. Whether to include referrer metadata. Defaults to false.',
  ),
  'max_results' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `maxResults` from the official Pulumi Cloud API operation. Maximum number of results for pagination',
  ),
  'role_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `roleID` from the official Pulumi Cloud API operation. The custom role to use for listing environments',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/esc/environments/{orgName}';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'continuationToken' => 'continuation_token',
  'includeReferrerMetadata' => 'include_referrer_metadata',
  'maxResults' => 'max_results',
  'roleID' => 'role_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all entitlements in a repository..
 *
 * Maps to the official Cloudsmith endpoint get /entitlements/{owner}/{repo}/.
 */
class CloudsmithEntitlementsList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_entitlements_list';
    protected const DESCRIPTION = 'Get a list of all entitlements in a repository.

Official Cloudsmith endpoint: GET /entitlements/{owner}/{repo}/

Get a list of all entitlements in a repository.';
    protected const PARAMETERS = array (
  'owner' => array (
  'type' => 'string',
  'description' => 'owner parameter.',
  'required' => true,
),
  'repo' => array (
  'type' => 'string',
  'description' => 'repo parameter.',
  'required' => true,
),
  'page' => array (
  'type' => 'string',
  'description' => 'A page number within the paginated result set.',
),
  'page_size' => array (
  'type' => 'string',
  'description' => 'Number of results to return per page.',
),
  'show_tokens' => array (
  'type' => 'string',
  'description' => 'Show entitlement token strings in results',
),
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying names of entitlements.',
),
  'active' => array (
  'type' => 'string',
  'description' => 'If true, only include active tokens',
),
  'exclude_other_user_tokens' => array (
  'type' => 'string',
  'description' => 'If true, exclude user tokens that belong to other users',
),
  'sort' => array (
  'type' => 'string',
  'description' => 'A field for sorting objects in ascending or descending order. Use `-` prefix for descending order (e.g., `-name`). Available options: name.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/entitlements/{owner}/{repo}/';
    protected const PATH_PARAMS = array (
  'owner' => 'owner',
  'repo' => 'repo',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'show_tokens' => 'show_tokens',
  'query' => 'query',
  'active' => 'active',
  'exclude_other_user_tokens' => 'exclude_other_user_tokens',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

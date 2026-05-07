<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get the details for all organization members..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/members/.
 */
class CloudsmithOrgsMembersList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_members_list';
    protected const DESCRIPTION = 'Get the details for all organization members.

Official Cloudsmith endpoint: GET /orgs/{org}/members/

Get the details for all organization members.';
    protected const PARAMETERS = array (
  'org' => array (
  'type' => 'string',
  'description' => 'org parameter.',
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
  'is_active' => array (
  'type' => 'string',
  'description' => 'Filter for active/inactive users.',
),
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying of members within an Organization.Available options are: email, org, user, userslug, inactive, user_name, role',
),
  'sort' => array (
  'type' => 'string',
  'description' => 'A field for sorting objects in ascending or descending order. Use `-` prefix for descending order (e.g., `-user_name`). Available options: user_name, role.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/members/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'is_active' => 'is_active',
  'query' => 'query',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

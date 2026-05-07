<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get the details of all teams within an organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/teams/.
 */
class CloudsmithOrgsTeamsList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_teams_list';
    protected const DESCRIPTION = 'Get the details of all teams within an organization.

Official Cloudsmith endpoint: GET /orgs/{org}/teams/

Get the details of all teams within an organization.';
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
  'for_user' => array (
  'type' => 'string',
  'description' => 'Filter for teams that you are a member of.',
),
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying of teams within an Organization.Available options are: name, slug, user, userslug',
),
  'sort' => array (
  'type' => 'string',
  'description' => 'A field for sorting objects in ascending or descending order. Use `-` prefix for descending order (e.g., `-name`). Available options: name, members.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/teams/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'for_user' => 'for_user',
  'query' => 'query',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

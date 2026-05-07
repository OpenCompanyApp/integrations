<?php

namespace OpenCompany\Integrations\Cloudsmith\Tools;

/**
 * Get a list of all services within an organization..
 *
 * Maps to the official Cloudsmith endpoint get /orgs/{org}/services/.
 */
class CloudsmithOrgsServicesList extends AbstractCloudsmithTool
{
    protected const NAME = 'cloudsmith_orgs_services_list';
    protected const DESCRIPTION = 'Get a list of all services within an organization.

Official Cloudsmith endpoint: GET /orgs/{org}/services/

Get a list of all services within an organization.';
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
  'query' => array (
  'type' => 'string',
  'description' => 'A search term for querying of services within an Organization.Available options are: name, role',
),
  'sort' => array (
  'type' => 'string',
  'description' => 'A field for sorting objects in ascending or descending order. Use `-` prefix for descending order (e.g., `-created_at`). Available options: created_at, name, role.',
),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org}/services/';
    protected const PATH_PARAMS = array (
  'org' => 'org',
);
    protected const QUERY_PARAMS = array (
  'page' => 'page',
  'page_size' => 'page_size',
  'query' => 'query',
  'sort' => 'sort',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

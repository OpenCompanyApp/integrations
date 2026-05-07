<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetResourceColumnFilterSet.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/search/column-set.
 */
class PulumiOrganizationsGetResourceColumnFilterSet extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_resource_column_filter_set';
    protected const DESCRIPTION = 'GetResourceColumnFilterSet

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/search/column-set

Returns aggregation results for a given field in resource search, providing the unique values and counts for a specific field like \'type\', \'package\', or \'project\'. This is used to populate filter dropdowns and faceted navigation in the resource search UI.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'field' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `field` from the official Pulumi Cloud API operation. The resource field to aggregate (e.g., \'type\', \'package\', \'project\')',
  ),
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `query` from the official Pulumi Cloud API operation. Search query string',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/search/column-set';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'field' => 'field',
  'query' => 'query',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * GetOrgResourceSearchV2Query.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/search/resourcesv2.
 */
class PulumiOrganizationsGetOrgResourceSearchV2Query extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_get_org_resource_search_v2_query';
    protected const DESCRIPTION = 'GetOrgResourceSearchV2Query

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/search/resourcesv2

Searches for resources within an organization with advanced filtering, sorting, and pagination capabilities. **Pagination:** The `page` parameter supports up to 10,000 results. For larger result sets, use the `cursor` parameter instead (Enterprise plans only). Note that pagination is not transactional - result ordering may change if a stack update completes during pagination. **Sorting:** The `sort` parameter accepts: `created`, `custom`, `delete`, `dependencies`, `id`, `modified`, `module`, `name`, `package`, `parentUrn`, `project`, `protected`, `providerUrn`, `stack`, `type`, `urn`, `managed`, `category`. If omitted, results are sorted by search relevance (or last modified time when no query is provided). **Properties:** Set `properties=true` to include resource input/output values. Requires a supported subscription - returns 402 if not available. **Collapse:** Set `collapse=true` t...';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
  ),
  'asc' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `asc` from the official Pulumi Cloud API operation. Sort in ascending order when true, descending when false',
  ),
  'collapse' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `collapse` from the official Pulumi Cloud API operation. Collapse results to show one entry per stack instead of per resource',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `cursor` from the official Pulumi Cloud API operation. Cursor for paginated results',
  ),
  'facet' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `facet` from the official Pulumi Cloud API operation. Facet filters to apply',
  ),
  'group_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `groupBy` from the official Pulumi Cloud API operation. Group results by this field',
  ),
  'page' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `page` from the official Pulumi Cloud API operation. Page number for pagination',
  ),
  'properties' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `properties` from the official Pulumi Cloud API operation. Include resource properties in search results (may increase response size)',
  ),
  'query' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `query` from the official Pulumi Cloud API operation. Search query string',
  ),
  'size' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `size` from the official Pulumi Cloud API operation. Number of results to return',
  ),
  'sort' =>
  array (
    'type' => 'array',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Pulumi Cloud API operation. Sort order for results',
  ),
  'top' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `top` from the official Pulumi Cloud API operation. Number of top aggregation buckets to return',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/api/orgs/{orgName}/search/resourcesv2';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'asc' => 'asc',
  'collapse' => 'collapse',
  'cursor' => 'cursor',
  'facet' => 'facet',
  'groupBy' => 'group_by',
  'page' => 'page',
  'properties' => 'properties',
  'query' => 'query',
  'size' => 'size',
  'sort' => 'sort',
  'top' => 'top',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

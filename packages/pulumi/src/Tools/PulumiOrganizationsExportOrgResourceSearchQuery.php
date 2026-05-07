<?php

namespace OpenCompany\Integrations\Pulumi\Tools;

/**
 * ExportOrgResourceSearchQuery.
 *
 * Maps to the official Pulumi Cloud endpoint get /api/orgs/{orgName}/search/resources/export.
 */
class PulumiOrganizationsExportOrgResourceSearchQuery extends AbstractPulumiTool
{
    protected const NAME = 'pulumi_organizations_export_org_resource_search_query';
    protected const DESCRIPTION = 'ExportOrgResourceSearchQuery

Official Pulumi Cloud endpoint: GET /api/orgs/{orgName}/search/resources/export

ExportOrgResourceSearchQuery exports resource search results as a CSV file download. Supports the same query parameters as the standard resource search to filter results.';
    protected const PARAMETERS = array (
  'org_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `orgName` from the official Pulumi Cloud API operation. The organization name',
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
    protected const PATH = '/api/orgs/{orgName}/search/resources/export';
    protected const PATH_PARAMS = array (
  'orgName' => 'org_name',
);
    protected const QUERY_PARAMS = array (
  'collapse' => 'collapse',
  'cursor' => 'cursor',
  'facet' => 'facet',
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

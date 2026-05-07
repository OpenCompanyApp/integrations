<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Retrieve asset search results (asynchronous) (Early Access).
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}/inventory/assets/searches/{search_id}/results.
 */
class SnykGetAssetSearchResultsTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_asset_search_results_tenant';
    protected const DESCRIPTION = 'Retrieve asset search results (asynchronous) (Early Access)

Official Snyk endpoint: GET /tenants/{tenant_id}/inventory/assets/searches/{search_id}/results

Gets paginated results for a previously initiated asset search #### Required permissions - `View Tenant Details (tenant.read)`';
    protected const PARAMETERS = array (
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. The unique identifier of the tenant',
  ),
  'search_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `search_id` from the official Snyk API operation. The unique identifier of the search operation',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested API version',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `sort` from the official Snyk API operation. Comma-separated sort fields. Prefix with `-` for descending order. **Supported fields:** - `created_at` - Asset creation timestamp - `upd...',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Cursor for next page',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Cursor for previous page',
  ),
  'fields' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `fields` from the official Snyk API operation. Sparse fieldsets allow clients to request only specific fields for a given resource type. Use the format `fields[]=field1,field2` where `...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}/inventory/assets/searches/{search_id}/results';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'search_id' => 'search_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'sort' => 'sort',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'fields' => 'fields',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

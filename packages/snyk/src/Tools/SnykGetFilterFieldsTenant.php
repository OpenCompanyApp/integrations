<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get available filter fields (Early Access).
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}/inventory/assets/filters.
 */
class SnykGetFilterFieldsTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_filter_fields_tenant';
    protected const DESCRIPTION = 'Get available filter fields (Early Access)

Official Snyk endpoint: GET /tenants/{tenant_id}/inventory/assets/filters

Returns a list of valid field names that can be used for filtering assets using RSQL. Each field includes its name, data type, and which asset types it applies to. #### Required permissions - `View Tenant Details (tenant.read)`';
    protected const PARAMETERS = array (
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. The unique identifier of the tenant',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested API version',
  ),
  'asset_types' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `asset_types` from the official Snyk API operation. Comma-separated list of asset types to filter the available filter fields',
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
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Cursor for fetching the next page of results',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Cursor for fetching the previous page of results',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}/inventory/assets/filters';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'asset_types' => 'asset_types',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

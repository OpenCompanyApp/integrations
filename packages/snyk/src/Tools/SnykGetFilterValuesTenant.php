<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get filter value suggestions (autocomplete) (Early Access).
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}/inventory/assets/filters/{filter_id}/values.
 */
class SnykGetFilterValuesTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_filter_values_tenant';
    protected const DESCRIPTION = 'Get filter value suggestions (autocomplete) (Early Access)

Official Snyk endpoint: GET /tenants/{tenant_id}/inventory/assets/filters/{filter_id}/values

Returns a list of distinct values for a specific filter field. Useful for building autocomplete functionality in filter UIs. Use the UUID from the filter fields list endpoint to identify which field to query. For object filter values, both the keys and values are returned. #### Required permissions - `View Tenant Details (tenant.read)`';
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
  'filter_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `filter_id` from the official Snyk API operation. The UUID of the filter field to get values for (from the filter fields list endpoint)',
  ),
  'q' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `q` from the official Snyk API operation. Full text search term to filter the list of values. If keys_only is true, this will filter the keys of the object filter values. If key i...',
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
  'keys_only' =>
  array (
    'type' => 'boolean',
    'required' => false,
    'description' => 'Query parameter `keys_only` from the official Snyk API operation. Return only the keys of the object filter values',
  ),
  'key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `key` from the official Snyk API operation. Return only the value for a specific key of the object filter values',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}/inventory/assets/filters/{filter_id}/values';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'filter_id' => 'filter_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'q' => 'q',
  'limit' => 'limit',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'keys_only' => 'keys_only',
  'key' => 'key',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create an asset search (asynchronous) (Early Access).
 *
 * Maps to the official Snyk endpoint post /tenants/{tenant_id}/inventory/assets/searches.
 */
class SnykCreateAssetSearchTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_asset_search_tenant';
    protected const DESCRIPTION = 'Create an asset search (asynchronous) (Early Access)

Official Snyk endpoint: POST /tenants/{tenant_id}/inventory/assets/searches

Initiates an asynchronous search for assets and returns a redirect to the search results endpoint #### Required permissions - `View Tenant Details (tenant.read)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/tenants/{tenant_id}/inventory/assets/searches';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

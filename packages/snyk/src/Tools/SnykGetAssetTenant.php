<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a single asset by ID (Early Access).
 *
 * Maps to the official Snyk endpoint get /tenants/{tenant_id}/inventory/assets/{asset_id}.
 */
class SnykGetAssetTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_asset_tenant';
    protected const DESCRIPTION = 'Get a single asset by ID (Early Access)

Official Snyk endpoint: GET /tenants/{tenant_id}/inventory/assets/{asset_id}

Retrieves a single asset by its unique identifier. The response includes the asset\'s details in JSON:API format. The asset type is determined from the database and the appropriate details are returned polymorphically. #### Required permissions - `View Tenant Details (tenant.read)`';
    protected const PARAMETERS = array (
  'tenant_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `tenant_id` from the official Snyk API operation. The unique identifier of the tenant',
  ),
  'asset_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `asset_id` from the official Snyk API operation. The unique identifier of the asset',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested API version',
  ),
  'fields' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `fields` from the official Snyk API operation. Sparse fieldsets allow clients to request only specific fields for a given resource type. Use the format `fields[]=field1,field2` where `...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tenants/{tenant_id}/inventory/assets/{asset_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'asset_id' => 'asset_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'fields' => 'fields',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

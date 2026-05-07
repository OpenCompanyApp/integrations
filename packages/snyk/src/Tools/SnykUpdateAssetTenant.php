<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update asset attributes (Early Access).
 *
 * Maps to the official Snyk endpoint patch /tenants/{tenant_id}/inventory/assets/{asset_id}.
 */
class SnykUpdateAssetTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_asset_tenant';
    protected const DESCRIPTION = 'Update asset attributes (Early Access)

Official Snyk endpoint: PATCH /tenants/{tenant_id}/inventory/assets/{asset_id}

Partially updates an asset\'s attributes. Supports updating class, labels (add/remove), and tags (add/remove). At least one attribute must be provided in the request. #### Required permissions - `Edit Tenant Details (tenant.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/tenants/{tenant_id}/inventory/assets/{asset_id}';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
  'asset_id' => 'asset_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

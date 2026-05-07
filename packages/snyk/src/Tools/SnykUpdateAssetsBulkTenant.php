<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Bulk update asset attributes (Early Access).
 *
 * Maps to the official Snyk endpoint patch /tenants/{tenant_id}/inventory/assets.
 */
class SnykUpdateAssetsBulkTenant extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_assets_bulk_tenant';
    protected const DESCRIPTION = 'Bulk update asset attributes (Early Access)

Official Snyk endpoint: PATCH /tenants/{tenant_id}/inventory/assets

Partially updates multiple assets in a single request. Maximum of 100 assets can be updated per request. The operation is transactional - all updates succeed or all fail. Supports updating class, labels (add/remove), and tags (add/remove). #### Required permissions - `Edit Tenant Details (tenant.edit)`';
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
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/tenants/{tenant_id}/inventory/assets';
    protected const PATH_PARAMS = array (
  'tenant_id' => 'tenant_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

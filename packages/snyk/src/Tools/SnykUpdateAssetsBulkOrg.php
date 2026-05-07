<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Bulk update asset attributes - Org scope (Early Access).
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/inventory/assets.
 */
class SnykUpdateAssetsBulkOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_assets_bulk_org';
    protected const DESCRIPTION = 'Bulk update asset attributes - Org scope (Early Access)

Official Snyk endpoint: PATCH /orgs/{org_id}/inventory/assets

Partially updates multiple assets within an org context. Maximum of 100 assets can be updated per request. The operation is transactional - all updates succeed or all fail. #### Required permissions - `Edit Organization (org.edit)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The unique identifier of the organization',
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
    protected const PATH = '/orgs/{org_id}/inventory/assets';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

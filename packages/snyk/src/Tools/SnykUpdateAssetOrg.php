<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update asset attributes - Org scope (Early Access).
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/inventory/assets/{asset_id}.
 */
class SnykUpdateAssetOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_asset_org';
    protected const DESCRIPTION = 'Update asset attributes - Org scope (Early Access)

Official Snyk endpoint: PATCH /orgs/{org_id}/inventory/assets/{asset_id}

Partially updates an asset\'s attributes within an org context. Supports updating class, labels (add/remove), and tags (add/remove). #### Required permissions - `Edit Organization (org.edit)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The unique identifier of the organization',
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
    protected const PATH = '/orgs/{org_id}/inventory/assets/{asset_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'asset_id' => 'asset_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

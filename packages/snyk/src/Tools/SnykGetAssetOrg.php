<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a single asset by ID - Org scope (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/inventory/assets/{asset_id}.
 */
class SnykGetAssetOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_asset_org';
    protected const DESCRIPTION = 'Get a single asset by ID - Org scope (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/inventory/assets/{asset_id}

Retrieves a single asset by its unique identifier within an org context. #### Required permissions - `View Organization (org.read)`';
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
  'fields' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Query parameter `fields` from the official Snyk API operation. Sparse fieldsets allow clients to request only specific fields for a given resource type. Use the format `fields[]=field1,field2` where `...',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/inventory/assets/{asset_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
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

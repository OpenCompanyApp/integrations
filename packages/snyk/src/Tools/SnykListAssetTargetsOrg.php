<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * List targets for an asset (org scope) (Early Access).
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/inventory/assets/{asset_id}/relationships/targets.
 */
class SnykListAssetTargetsOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_list_asset_targets_org';
    protected const DESCRIPTION = 'List targets for an asset (org scope) (Early Access)

Official Snyk endpoint: GET /orgs/{org_id}/inventory/assets/{asset_id}/relationships/targets

Retrieves a paginated list of Snyk targets linked to this asset with full attributes. Returns the `id`, `type`, and `attributes` of each related target. Scoped to the specified organization. #### Required permissions - `View Organization (org.read)`';
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
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Maximum number of results to return per page',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/inventory/assets/{asset_id}/relationships/targets';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'asset_id' => 'asset_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

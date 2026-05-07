<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create an asset search (asynchronous) - Org scope (Early Access).
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/inventory/assets/searches.
 */
class SnykCreateAssetSearchOrg extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_asset_search_org';
    protected const DESCRIPTION = 'Create an asset search (asynchronous) - Org scope (Early Access)

Official Snyk endpoint: POST /orgs/{org_id}/inventory/assets/searches

Initiates an asynchronous search for assets within an org context. #### Required permissions - `View Organization (org.read)`';
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
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/inventory/assets/searches';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

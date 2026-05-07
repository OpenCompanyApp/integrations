<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a Snyk App by app ID.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/apps/creations/{app_id}.
 */
class SnykGetAppByID extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_app_by_id';
    protected const DESCRIPTION = 'Get a Snyk App by app ID

Official Snyk endpoint: GET /orgs/{org_id}/apps/creations/{app_id}

Get a Snyk App by app ID #### Required permissions - `View Apps (org.app.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'app_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `app_id` from the official Snyk API operation. App ID',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/apps/creations/{app_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'app_id' => 'app_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

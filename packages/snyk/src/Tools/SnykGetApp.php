<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get an app by client id.
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/apps/{client_id}.
 */
class SnykGetApp extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_app';
    protected const DESCRIPTION = 'Get an app by client id

Official Snyk endpoint: GET /orgs/{org_id}/apps/{client_id}

Get an App by client id. Deprecated, use /orgs/{org_id}/apps/creations/{app_id} instead. #### Required permissions - `View Apps (org.app.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Org ID',
  ),
  'client_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `client_id` from the official Snyk API operation. Client ID',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/apps/{client_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'client_id' => 'client_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update app attributes that are name, redirect URIs, and access token time to live.
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/apps/{client_id}.
 */
class SnykUpdateApp extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_app';
    protected const DESCRIPTION = 'Update app attributes that are name, redirect URIs, and access token time to live

Official Snyk endpoint: PATCH /orgs/{org_id}/apps/{client_id}

Update app attributes. Deprecated, use /orgs/{org_id}/apps/creations/{app_id} instead. #### Required permissions - `Edit Apps (org.app.edit)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
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

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update app creation attributes such as name, redirect URIs, and access token time to live using the App ID.
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/apps/creations/{app_id}.
 */
class SnykUpdateAppCreationByID extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_app_creation_by_id';
    protected const DESCRIPTION = 'Update app creation attributes such as name, redirect URIs, and access token time to live using the App ID

Official Snyk endpoint: PATCH /orgs/{org_id}/apps/creations/{app_id}

Update app creation attributes with App ID #### Required permissions - `Edit Apps (org.app.edit)`';
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
  'app_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `app_id` from the official Snyk API operation. App ID',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
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

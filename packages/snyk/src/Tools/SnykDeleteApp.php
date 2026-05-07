<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete an app.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/apps/{client_id}.
 */
class SnykDeleteApp extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_app';
    protected const DESCRIPTION = 'Delete an app

Official Snyk endpoint: DELETE /orgs/{org_id}/apps/{client_id}

Delete an app by app id. Deprecated, use /orgs/{org_id}/apps/creations/{app_id} instead. #### Required permissions - `Delete Apps (org.app.delete)`';
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
);
    protected const METHOD = 'delete';
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

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Revoke a Snyk App by app ID.
 *
 * Maps to the official Snyk endpoint delete /self/apps/{app_id}.
 */
class SnykRevokeUserInstalledApp extends AbstractSnykTool
{
    protected const NAME = 'snyk_revoke_user_installed_app';
    protected const DESCRIPTION = 'Revoke a Snyk App by app ID

Official Snyk endpoint: DELETE /self/apps/{app_id}

Revoke access for an app by app id';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'app_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `app_id` from the official Snyk API operation. App ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/self/apps/{app_id}';
    protected const PATH_PARAMS = array (
  'app_id' => 'app_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Revoke app bot authorization.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/app_bots/{bot_id}.
 */
class SnykDeleteAppBot extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_app_bot';
    protected const DESCRIPTION = 'Revoke app bot authorization

Official Snyk endpoint: DELETE /orgs/{org_id}/app_bots/{bot_id}

Revoke app bot authorization. Deprecated, use /orgs/{org_id}/apps/installs/{install_id} instead. #### Required permissions - `Install Apps (org.app.install)`';
    protected const PARAMETERS = array (
  'bot_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `bot_id` from the official Snyk API operation. The ID of the app bot',
  ),
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
    'description' => 'Path parameter `org_id` from the official Snyk API operation. Organization ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/app_bots/{bot_id}';
    protected const PATH_PARAMS = array (
  'bot_id' => 'bot_id',
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

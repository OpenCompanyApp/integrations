<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Revoke a Snyk App by install ID.
 *
 * Maps to the official Snyk endpoint delete /self/apps/installs/{install_id}.
 */
class SnykDeleteUserAppInstallById extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_user_app_install_by_id';
    protected const DESCRIPTION = 'Revoke a Snyk App by install ID

Official Snyk endpoint: DELETE /self/apps/installs/{install_id}

Revoke a Snyk App by install ID';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'install_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `install_id` from the official Snyk API operation. Install ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/self/apps/installs/{install_id}';
    protected const PATH_PARAMS = array (
  'install_id' => 'install_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

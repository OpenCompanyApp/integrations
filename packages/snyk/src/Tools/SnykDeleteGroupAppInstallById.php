<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Revoke app authorization for a Snyk group with install ID.
 *
 * Maps to the official Snyk endpoint delete /groups/{group_id}/apps/installs/{install_id}.
 */
class SnykDeleteGroupAppInstallById extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_group_app_install_by_id';
    protected const DESCRIPTION = 'Revoke app authorization for a Snyk group with install ID

Official Snyk endpoint: DELETE /groups/{group_id}/apps/installs/{install_id}

Revoke app authorization for a Snyk group with install ID #### Required permissions - `Install Apps (group.app.install)`';
    protected const PARAMETERS = array (
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. Group ID',
  ),
  'install_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `install_id` from the official Snyk API operation. Install ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/groups/{group_id}/apps/installs/{install_id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'install_id' => 'install_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Revoke app authorization for a Snyk organization with install ID.
 *
 * Maps to the official Snyk endpoint delete /orgs/{org_id}/apps/installs/{install_id}.
 */
class SnykDeleteAppOrgInstallById extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_app_org_install_by_id';
    protected const DESCRIPTION = 'Revoke app authorization for a Snyk organization with install ID

Official Snyk endpoint: DELETE /orgs/{org_id}/apps/installs/{install_id}

Revoke app authorization for a Snyk organization with install ID #### Required permissions - `Install Apps (org.app.install)`';
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
  'install_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `install_id` from the official Snyk API operation. Install ID',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/orgs/{org_id}/apps/installs/{install_id}';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'install_id' => 'install_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

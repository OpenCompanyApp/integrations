<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Manage client secret for non-interactive Snyk App installations.
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/apps/installs/{install_id}/secrets.
 */
class SnykUpdateOrgAppInstallSecret extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_app_install_secret';
    protected const DESCRIPTION = 'Manage client secret for non-interactive Snyk App installations

Official Snyk endpoint: POST /orgs/{org_id}/apps/installs/{install_id}/secrets

Manage client secret for non-interactive Snyk App installations #### Required permissions - `Edit Apps (org.app.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/apps/installs/{install_id}/secrets';
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

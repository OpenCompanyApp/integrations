<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Manage client secrets for an app..
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/apps/{client_id}/secrets.
 */
class SnykManageSecrets extends AbstractSnykTool
{
    protected const NAME = 'snyk_manage_secrets';
    protected const DESCRIPTION = 'Manage client secrets for an app.

Official Snyk endpoint: POST /orgs/{org_id}/apps/{client_id}/secrets

Manage client secrets for an app. Deprecated, use /orgs/{org_id}/apps/creations/{app_id}/secrets instead. #### Required permissions - `Edit Apps (org.app.edit)`';
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
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/apps/{client_id}/secrets';
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

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Manage an organization service account's client secret..
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/service_accounts/{serviceaccount_id}/secrets.
 */
class SnykUpdateOrgServiceAccountSecret extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_service_account_secret';
    protected const DESCRIPTION = 'Manage an organization service account\'s client secret.

Official Snyk endpoint: POST /orgs/{org_id}/service_accounts/{serviceaccount_id}/secrets

Manage the client secret of an organization service account by the service account ID. #### Required permissions - `Edit service accounts (org.service_account.edit)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of the Snyk Organization that owns the service account.',
  ),
  'serviceaccount_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `serviceaccount_id` from the official Snyk API operation. The ID of the service account.',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/orgs/{org_id}/service_accounts/{serviceaccount_id}/secrets';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
  'serviceaccount_id' => 'serviceaccount_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

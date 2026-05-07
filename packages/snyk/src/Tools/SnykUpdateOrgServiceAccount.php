<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update an organization service account..
 *
 * Maps to the official Snyk endpoint patch /orgs/{org_id}/service_accounts/{serviceaccount_id}.
 */
class SnykUpdateOrgServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_org_service_account';
    protected const DESCRIPTION = 'Update an organization service account.

Official Snyk endpoint: PATCH /orgs/{org_id}/service_accounts/{serviceaccount_id}

Update the name of an organization-level service account by its ID. #### Required permissions - `Edit service accounts (org.service_account.edit)`';
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
    protected const METHOD = 'patch';
    protected const PATH = '/orgs/{org_id}/service_accounts/{serviceaccount_id}';
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

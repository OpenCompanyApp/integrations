<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get an organization service account..
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/service_accounts/{serviceaccount_id}.
 */
class SnykGetOneOrgServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_one_org_service_account';
    protected const DESCRIPTION = 'Get an organization service account.

Official Snyk endpoint: GET /orgs/{org_id}/service_accounts/{serviceaccount_id}

Get an organization-level service account by its ID. #### Required permissions - `View service accounts (org.service_account.read)`';
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
);
    protected const METHOD = 'get';
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
    protected const BODY_REQUIRED = false;
}

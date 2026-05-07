<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a service account for an organization..
 *
 * Maps to the official Snyk endpoint post /orgs/{org_id}/service_accounts.
 */
class SnykCreateOrgServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_org_service_account';
    protected const DESCRIPTION = 'Create a service account for an organization.

Official Snyk endpoint: POST /orgs/{org_id}/service_accounts

Create a service account for an organization. The service account can be used to access the Snyk API. #### Required permissions - `Create service accounts (org.service_account.create)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of the Snyk Organization that is creating and will own the service account.',
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
    protected const PATH = '/orgs/{org_id}/service_accounts';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

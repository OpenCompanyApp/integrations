<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a list of organization service accounts..
 *
 * Maps to the official Snyk endpoint get /orgs/{org_id}/service_accounts.
 */
class SnykGetManyOrgServiceAccounts extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_many_org_service_accounts';
    protected const DESCRIPTION = 'Get a list of organization service accounts.

Official Snyk endpoint: GET /orgs/{org_id}/service_accounts

Get all service accounts for an organization. #### Required permissions - `View service accounts (org.service_account.read)`';
    protected const PARAMETERS = array (
  'org_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `org_id` from the official Snyk API operation. The ID of the Snyk Organization that owns the service accounts.',
  ),
  'starting_after' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `starting_after` from the official Snyk API operation. Return the page of results immediately after this cursor',
  ),
  'ending_before' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `ending_before` from the official Snyk API operation. Return the page of results immediately before this cursor',
  ),
  'limit' =>
  array (
    'type' => 'integer',
    'required' => false,
    'description' => 'Query parameter `limit` from the official Snyk API operation. Number of results to return per page',
  ),
  'version' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Query parameter `version` from the official Snyk API operation. The requested version of the endpoint to process the request',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/orgs/{org_id}/service_accounts';
    protected const PATH_PARAMS = array (
  'org_id' => 'org_id',
);
    protected const QUERY_PARAMS = array (
  'starting_after' => 'starting_after',
  'ending_before' => 'ending_before',
  'limit' => 'limit',
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

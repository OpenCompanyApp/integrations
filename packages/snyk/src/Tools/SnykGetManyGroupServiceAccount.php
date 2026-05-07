<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a list of group service accounts..
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/service_accounts.
 */
class SnykGetManyGroupServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_many_group_service_account';
    protected const DESCRIPTION = 'Get a list of group service accounts.

Official Snyk endpoint: GET /groups/{group_id}/service_accounts

Get all service accounts for a group. #### Required permissions - `View service accounts (group.service_account.read)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the Snyk Group that owns the service accounts.',
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
    protected const PATH = '/groups/{group_id}/service_accounts';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
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

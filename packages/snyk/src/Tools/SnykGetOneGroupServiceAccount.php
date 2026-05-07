<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Get a group service account..
 *
 * Maps to the official Snyk endpoint get /groups/{group_id}/service_accounts/{serviceaccount_id}.
 */
class SnykGetOneGroupServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_get_one_group_service_account';
    protected const DESCRIPTION = 'Get a group service account.

Official Snyk endpoint: GET /groups/{group_id}/service_accounts/{serviceaccount_id}

Get a group-level service account by its ID. #### Required permissions - `View service accounts (group.service_account.read)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the Snyk Group that owns the service account.',
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
    protected const PATH = '/groups/{group_id}/service_accounts/{serviceaccount_id}';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
  'serviceaccount_id' => 'serviceaccount_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Update a group service account..
 *
 * Maps to the official Snyk endpoint patch /groups/{group_id}/service_accounts/{serviceaccount_id}.
 */
class SnykUpdateGroupServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_group_service_account';
    protected const DESCRIPTION = 'Update a group service account.

Official Snyk endpoint: PATCH /groups/{group_id}/service_accounts/{serviceaccount_id}

Update the name of a group\'s service account by its ID. #### Required permissions - `Edit service accounts (group.service_account.edit)`';
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
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Snyk API request schema.',
  ),
);
    protected const METHOD = 'patch';
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
    protected const BODY_REQUIRED = true;
}

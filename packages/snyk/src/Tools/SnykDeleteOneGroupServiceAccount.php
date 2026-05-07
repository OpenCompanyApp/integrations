<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Delete a group service account..
 *
 * Maps to the official Snyk endpoint delete /groups/{group_id}/service_accounts/{serviceaccount_id}.
 */
class SnykDeleteOneGroupServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_delete_one_group_service_account';
    protected const DESCRIPTION = 'Delete a group service account.

Official Snyk endpoint: DELETE /groups/{group_id}/service_accounts/{serviceaccount_id}

Permanently delete a group-level service account by its ID. #### Required permissions - `Delete service accounts (group.service_account.delete)`';
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
    protected const METHOD = 'delete';
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

<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Create a service account for a group..
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/service_accounts.
 */
class SnykCreateGroupServiceAccount extends AbstractSnykTool
{
    protected const NAME = 'snyk_create_group_service_account';
    protected const DESCRIPTION = 'Create a service account for a group.

Official Snyk endpoint: POST /groups/{group_id}/service_accounts

Create a service account for a group. The service account can be used to access the Snyk API. #### Required permissions - `Create service accounts (group.service_account.create)`';
    protected const PARAMETERS = array (
  'group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `group_id` from the official Snyk API operation. The ID of the Snyk Group that is creating and owns the service account',
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
    protected const PATH = '/groups/{group_id}/service_accounts';
    protected const PATH_PARAMS = array (
  'group_id' => 'group_id',
);
    protected const QUERY_PARAMS = array (
  'version' => 'version',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

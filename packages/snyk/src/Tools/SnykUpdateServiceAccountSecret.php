<?php

namespace OpenCompany\Integrations\Snyk\Tools;

/**
 * Manage a group service account's client secret..
 *
 * Maps to the official Snyk endpoint post /groups/{group_id}/service_accounts/{serviceaccount_id}/secrets.
 */
class SnykUpdateServiceAccountSecret extends AbstractSnykTool
{
    protected const NAME = 'snyk_update_service_account_secret';
    protected const DESCRIPTION = 'Manage a group service account\'s client secret.

Official Snyk endpoint: POST /groups/{group_id}/service_accounts/{serviceaccount_id}/secrets

Manage the client secret of a group service account by the service account ID. #### Required permissions - `Edit service accounts (group.service_account.edit)`';
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
    protected const METHOD = 'post';
    protected const PATH = '/groups/{group_id}/service_accounts/{serviceaccount_id}/secrets';
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

<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a connected account.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/{user_id}/connected_accounts/{slug}.
 */
class WorkOSDataIntegrationsUserManagementGetUserDataInstallation extends AbstractWorkOSTool
{
    protected const NAME = 'workos_data_integrations_user_management_get_user_data_installation';
    protected const DESCRIPTION = 'Get a connected account

Official WorkOS endpoint: GET /user_management/users/{user_id}/connected_accounts/{slug}

Retrieves a user\'s [connected account](/reference/pipes/connected-account) for a specific provider.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `user_id` from the official WorkOS API operation.',
  ),
  'slug' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `slug` from the official WorkOS API operation.',
  ),
  'organization_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Query parameter `organization_id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/users/{user_id}/connected_accounts/{slug}';
    protected const PATH_PARAMS = array (
  'user_id' => 'user_id',
  'slug' => 'slug',
);
    protected const QUERY_PARAMS = array (
  'organization_id' => 'organization_id',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

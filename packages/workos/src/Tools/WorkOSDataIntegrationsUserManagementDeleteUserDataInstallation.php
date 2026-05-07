<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a connected account.
 *
 * Maps to the official WorkOS endpoint delete /user_management/users/{user_id}/connected_accounts/{slug}.
 */
class WorkOSDataIntegrationsUserManagementDeleteUserDataInstallation extends AbstractWorkOSTool
{
    protected const NAME = 'workos_data_integrations_user_management_delete_user_data_installation';
    protected const DESCRIPTION = 'Delete a connected account

Official WorkOS endpoint: DELETE /user_management/users/{user_id}/connected_accounts/{slug}

Disconnects WorkOS\'s account for the user, including removing any stored access and refresh tokens. The user will need to reauthorize if they want to reconnect. This does not revoke access on the provider side.';
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
    protected const METHOD = 'delete';
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

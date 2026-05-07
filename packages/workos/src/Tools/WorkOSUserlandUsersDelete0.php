<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Delete a user.
 *
 * Maps to the official WorkOS endpoint delete /user_management/users/{id}.
 */
class WorkOSUserlandUsersDelete0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_delete_0';
    protected const DESCRIPTION = 'Delete a user

Official WorkOS endpoint: DELETE /user_management/users/{id}

Permanently deletes a user in the current environment. It cannot be undone.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/user_management/users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

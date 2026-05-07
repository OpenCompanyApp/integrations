<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a password reset token.
 *
 * Maps to the official WorkOS endpoint get /user_management/password_reset/{id}.
 */
class WorkOSUserlandUsersGetPasswordReset extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_get_password_reset';
    protected const DESCRIPTION = 'Get a password reset token

Official WorkOS endpoint: GET /user_management/password_reset/{id}

Get the details of an existing password reset token that can be used to reset a user\'s password.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user_management/password_reset/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Reset the password.
 *
 * Maps to the official WorkOS endpoint post /user_management/password_reset/confirm.
 */
class WorkOSUserlandUsersResetPassword0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_reset_password_0';
    protected const DESCRIPTION = 'Reset the password

Official WorkOS endpoint: POST /user_management/password_reset/confirm

Sets a new password using the `token` query parameter from the link that the user received. Successfully resetting the password will verify a user\'s email, if it hasn\'t been verified yet.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/password_reset/confirm';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a password reset token.
 *
 * Maps to the official WorkOS endpoint post /user_management/password_reset.
 */
class WorkOSUserlandUsersCreatePasswordResetToken extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_create_password_reset_token';
    protected const DESCRIPTION = 'Create a password reset token

Official WorkOS endpoint: POST /user_management/password_reset

Creates a one-time token that can be used to reset a user\'s password.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/password_reset';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

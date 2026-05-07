<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Create a user.
 *
 * Maps to the official WorkOS endpoint post /user_management/users.
 */
class WorkOSUserlandUsersCreate0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_create_0';
    protected const DESCRIPTION = 'Create a user

Official WorkOS endpoint: POST /user_management/users

Create a new user in the current environment.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user_management/users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Get a user.
 *
 * Maps to the official WorkOS endpoint get /user_management/users/{id}.
 */
class WorkOSUserlandUsersGet0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_get_0';
    protected const DESCRIPTION = 'Get a user

Official WorkOS endpoint: GET /user_management/users/{id}

Get the details of an existing user.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
);
    protected const METHOD = 'get';
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

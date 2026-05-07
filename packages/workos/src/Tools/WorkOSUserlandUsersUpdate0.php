<?php

namespace OpenCompany\Integrations\WorkOS\Tools;

/**
 * Update a user.
 *
 * Maps to the official WorkOS endpoint put /user_management/users/{id}.
 */
class WorkOSUserlandUsersUpdate0 extends AbstractWorkOSTool
{
    protected const NAME = 'workos_userland_users_update_0';
    protected const DESCRIPTION = 'Update a user

Official WorkOS endpoint: PUT /user_management/users/{id}

Updates properties of a user. The omitted properties will be left unchanged.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official WorkOS API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official WorkOS OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/user_management/users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Update a User.
 *
 * Maps to the official Fivetran endpoint patch /v1/users/{userId}.
 */
class FivetranModifyUser extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_modify_user';
    protected const DESCRIPTION = 'Update a User

Official Fivetran endpoint: PATCH /v1/users/{userId}

Updates information for an existing user within your Fivetran account.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `userId` from the official Fivetran API operation. The unique identifier for the user within the account.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the official Fivetran API request schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/v1/users/{userId}';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Delete a User.
 *
 * Maps to the official Fivetran endpoint delete /v1/users/{id}.
 */
class FivetranDeleteUser extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_delete_user';
    protected const DESCRIPTION = 'Delete a User

Official Fivetran endpoint: DELETE /v1/users/{id}

Deletes a user from your Fivetran account. You will be unable to delete an account owner user if there is only one remaining.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Path parameter `id` from the official Fivetran API operation. The unique identifier for the user within the account.',
  ),
  'accept' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Accept` from the official Fivetran API operation.',
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/v1/users/{id}';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Fivetran\Tools;

/**
 * Invite a User.
 *
 * Maps to the official Fivetran endpoint post /v1/users.
 */
class FivetranCreateUser extends AbstractFivetranTool
{
    protected const NAME = 'fivetran_create_user';
    protected const DESCRIPTION = 'Invite a User

Official Fivetran endpoint: POST /v1/users

Invites a new user to your Fivetran account. The invited user will have access to the account only after accepting the invitation. Invited user details are still accessible through the API.';
    protected const PARAMETERS = array (
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
    protected const METHOD = 'post';
    protected const PATH = '/v1/users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Brex\Tools;

/**
 * Invite user.
 *
 * Maps to the official Brex endpoint post /v2/users.
 */
class BrexTeamCreateUser extends AbstractBrexTool
{
    protected const NAME = 'brex_team_create_user';
    protected const DESCRIPTION = 'Invite user

Official Brex endpoint: POST /v2/users

This endpoint invites a new user as an employee. To update user\'s role, check out [this article](https://support.brex.com/how-do-i-change-another-user-s-role/).';
    protected const PARAMETERS = array (
  'idempotency_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Header parameter `Idempotency-Key` from the official Brex API operation.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => true,
    'description' => 'JSON request body matching the official Brex OpenAPI request schema for this operation.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v2/users';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Idempotency-Key' => 'idempotency_key',
);
    protected const BODY_REQUIRED = true;
}

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get a user.
 *
 * Maps to the official Tailscale endpoint get /users/{userId}.
 */
class TailscaleGetUser extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_user';
    protected const DESCRIPTION = 'Get a user

Official Tailscale endpoint: GET /users/{userId}

Retrieve details about the specified user.

OAuth Scope: `users:read`.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/users/{userId}';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Update user role.
 *
 * Maps to the official Tailscale endpoint post /users/{userId}/role.
 */
class TailscaleUpdateUserRole extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_update_user_role';
    protected const DESCRIPTION = 'Update user role

Official Tailscale endpoint: POST /users/{userId}/role

Update the role for the specified user.

Learn more about [user roles](kb/1138/user-roles).

OAuth Scope: `users`.

> ⓘ User-based access tokens cannot update their own user\'s role.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/users/{userId}/role';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

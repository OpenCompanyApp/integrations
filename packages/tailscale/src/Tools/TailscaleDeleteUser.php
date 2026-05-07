<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Delete a user.
 *
 * Maps to the official Tailscale endpoint post /users/{userId}/delete.
 */
class TailscaleDeleteUser extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_delete_user';
    protected const DESCRIPTION = 'Delete a user

Official Tailscale endpoint: POST /users/{userId}/delete

Delete a user from their tailnet. Learn more about [deleting users](/kb/1145/remove-team-members#deleting-users).

OAuth Scope: `users`.

> ⓘ User-based access tokens cannot delete their own user.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/users/{userId}/delete';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

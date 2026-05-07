<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Restore a user.
 *
 * Maps to the official Tailscale endpoint post /users/{userId}/restore.
 */
class TailscaleRestoreUser extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_restore_user';
    protected const DESCRIPTION = 'Restore a user

Official Tailscale endpoint: POST /users/{userId}/restore

Restores a suspended user\'s access to their tailnet. Learn more about [restoring users](/kb/1145/remove-team-members#restoring-users).

OAuth Scope: `users`.

> ⓘ User-based access tokens cannot restore their own user.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/users/{userId}/restore';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

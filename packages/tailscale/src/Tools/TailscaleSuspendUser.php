<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Suspend a user.
 *
 * Maps to the official Tailscale endpoint post /users/{userId}/suspend.
 */
class TailscaleSuspendUser extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_suspend_user';
    protected const DESCRIPTION = 'Suspend a user

Official Tailscale endpoint: POST /users/{userId}/suspend

Suspends a user from their tailnet. Learn more about [suspending users](/kb/1145/remove-team-members#suspending-users).

OAuth Scope: `users`.

> ⓘ User-based access tokens cannot suspend their own user.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/users/{userId}/suspend';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

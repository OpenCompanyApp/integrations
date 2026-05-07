<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Approve a user.
 *
 * Maps to the official Tailscale endpoint post /users/{userId}/approve.
 */
class TailscaleApproveUser extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_approve_user';
    protected const DESCRIPTION = 'Approve a user

Official Tailscale endpoint: POST /users/{userId}/approve

Approve a pending user\'s access to the tailnet.
This is a no-op if user approval has not been enabled for the tailnet, or if the user is already approved.

User approval can be managed using the [tailnet settings endpoints](#tag/tailnetsettings).

Learn more about [user approval](/kb/1239/user-approval) and [enabling user approval for your network](/kb/1239/user-approval#enable-user-approval-for-your-network).

OAuth Scope: `users`.

> ⓘ User-based access tokens cannot approve their own user.';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/users/{userId}/approve';
    protected const PATH_PARAMS = array (
  'userId' => 'user_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

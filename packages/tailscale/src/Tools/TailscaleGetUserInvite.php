<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get a user invite.
 *
 * Maps to the official Tailscale endpoint get /user-invites/{userInviteId}.
 */
class TailscaleGetUserInvite extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_user_invite';
    protected const DESCRIPTION = 'Get a user invite

Official Tailscale endpoint: GET /user-invites/{userInviteId}

Retrieve a specific user invite.';
    protected const PARAMETERS = array (
  'user_invite_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user invite.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/user-invites/{userInviteId}';
    protected const PATH_PARAMS = array (
  'userInviteId' => 'user_invite_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

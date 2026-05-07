<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Delete a user invite.
 *
 * Maps to the official Tailscale endpoint delete /user-invites/{userInviteId}.
 */
class TailscaleDeleteUserInvite extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_delete_user_invite';
    protected const DESCRIPTION = 'Delete a user invite

Official Tailscale endpoint: DELETE /user-invites/{userInviteId}

Deletes a specific user invite.

> ⓘ Only permitted for user-owned keys, because invites require an inviting user.';
    protected const PARAMETERS = array (
  'user_invite_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user invite.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
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

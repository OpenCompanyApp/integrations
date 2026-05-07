<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Resend a user invite.
 *
 * Maps to the official Tailscale endpoint post /user-invites/{userInviteId}/resend.
 */
class TailscaleResendUserInvite extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_resend_user_invite';
    protected const DESCRIPTION = 'Resend a user invite

Official Tailscale endpoint: POST /user-invites/{userInviteId}/resend

Resend a user invite by email. You can only use this if the specified invite
was originally created with an email specified.
Refer to [creating user invites for a tailnet](#tag/userinvites/post/tailnet/{tailnet}/user-invites).

Note: Invite resends are rate limited to one per minute.

> ⓘ Only permitted for user-owned keys, because invites require an inviting user.';
    protected const PARAMETERS = array (
  'user_invite_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the user invite.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/user-invites/{userInviteId}/resend';
    protected const PATH_PARAMS = array (
  'userInviteId' => 'user_invite_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

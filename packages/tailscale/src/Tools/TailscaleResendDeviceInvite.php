<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Resend a device invite.
 *
 * Maps to the official Tailscale endpoint post /device-invites/{deviceInviteId}/resend.
 */
class TailscaleResendDeviceInvite extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_resend_device_invite';
    protected const DESCRIPTION = 'Resend a device invite

Official Tailscale endpoint: POST /device-invites/{deviceInviteId}/resend

Resend a device invite by email. You can only use this if the specified invite
was originally created with an email specified.
Refer to [creating device invites for a device](#tag/deviceinvites/post/device/{deviceId}/device-invites).

Note: Invite resends are rate limited to one per minute.

Note that device invites cannot be resent using an API access token generated from an OAuth client as the shared device is scoped to a user.';
    protected const PARAMETERS = array (
  'device_invite_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device invite.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/device-invites/{deviceInviteId}/resend';
    protected const PATH_PARAMS = array (
  'deviceInviteId' => 'device_invite_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

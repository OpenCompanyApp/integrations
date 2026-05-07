<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Delete a device invite.
 *
 * Maps to the official Tailscale endpoint delete /device-invites/{deviceInviteId}.
 */
class TailscaleDeleteDeviceInvite extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_delete_device_invite';
    protected const DESCRIPTION = 'Delete a device invite

Official Tailscale endpoint: DELETE /device-invites/{deviceInviteId}

Delete a specific device invite.

OAuth Scope: `device_invites`.';
    protected const PARAMETERS = array (
  'device_invite_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device invite.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/device-invites/{deviceInviteId}';
    protected const PATH_PARAMS = array (
  'deviceInviteId' => 'device_invite_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get a device invite.
 *
 * Maps to the official Tailscale endpoint get /device-invites/{deviceInviteId}.
 */
class TailscaleGetDeviceInvite extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_device_invite';
    protected const DESCRIPTION = 'Get a device invite

Official Tailscale endpoint: GET /device-invites/{deviceInviteId}

Retrieve a specific device invite.

OAuth Scope: `device_invites:read`.';
    protected const PARAMETERS = array (
  'device_invite_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device invite.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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

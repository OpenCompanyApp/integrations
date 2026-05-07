<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Accept a device invite.
 *
 * Maps to the official Tailscale endpoint post /device-invites/-/accept.
 */
class TailscaleAcceptDeviceInvite extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_accept_device_invite';
    protected const DESCRIPTION = 'Accept a device invite

Official Tailscale endpoint: POST /device-invites/-/accept

Accepts the invitation to share a device into the requesting user\'s tailnet.

Note that device invites cannot be accepted using an API access token generated from an OAuth client as the shared device is scoped to a user.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/device-invites/-/accept';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

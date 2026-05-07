<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Create device invites.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/device-invites.
 */
class TailscaleCreateDeviceInvites extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_create_device_invites';
    protected const DESCRIPTION = 'Create device invites

Official Tailscale endpoint: POST /device/{deviceId}/device-invites

Create new share invites for a device.

Note that device invites cannot be created using an API access token generated from an OAuth client as the shared device is scoped to a user.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'Device invites to create.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/device/{deviceId}/device-invites';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * List device invites.
 *
 * Maps to the official Tailscale endpoint get /device/{deviceId}/device-invites.
 */
class TailscaleListDeviceInvites extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_list_device_invites';
    protected const DESCRIPTION = 'List device invites

Official Tailscale endpoint: GET /device/{deviceId}/device-invites

List all share invites for a device.

OAuth Scope: `device_invites:read`.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
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

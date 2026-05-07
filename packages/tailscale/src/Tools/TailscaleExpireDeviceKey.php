<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Expire a device's key.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/expire.
 */
class TailscaleExpireDeviceKey extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_expire_device_key';
    protected const DESCRIPTION = 'Expire a device\'s key

Official Tailscale endpoint: POST /device/{deviceId}/expire

Mark a device\'s node key as expired.
This will require the device to re-authenticate in order to connect to the tailnet.
The device must belong to the requesting user\'s tailnet.

OAuth Scope: `devices:core`.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/device/{deviceId}/expire';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

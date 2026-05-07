<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Update device key.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/key.
 */
class TailscaleUpdateDeviceKey extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_update_device_key';
    protected const DESCRIPTION = 'Update device key

Official Tailscale endpoint: POST /device/{deviceId}/key

When a device is added to a tailnet, its key expiry is set according to the tailnet\'s key expiry setting.
If the key is not refreshed and expires, the device can no longer communicate with other devices in the tailnet.

OAuth Scope: `devices:core`.';
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
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/device/{deviceId}/key';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

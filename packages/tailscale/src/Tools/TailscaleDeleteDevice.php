<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Delete a device.
 *
 * Maps to the official Tailscale endpoint delete /device/{deviceId}.
 */
class TailscaleDeleteDevice extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_delete_device';
    protected const DESCRIPTION = 'Delete a device

Official Tailscale endpoint: DELETE /device/{deviceId}

Deletes the device from its tailnet.
The device must belong to the requesting user\'s tailnet.
Deleting devices shared with the tailnet is not supported.

OAuth Scope: `devices:core`.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/device/{deviceId}';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

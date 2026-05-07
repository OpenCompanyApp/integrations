<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set device IPv4 address.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/ip.
 */
class TailscaleSetDeviceIp extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_device_ip';
    protected const DESCRIPTION = 'Set device IPv4 address

Official Tailscale endpoint: POST /device/{deviceId}/ip

When a device is added to a tailnet, its Tailscale IPv4 address is set at random either from the CGNAT range,
or a subset of the CGNAT range specified by an [ip pool](https://tailscale.com/kb/1304/ip-pool).
This endpoint can be used to replace the existing IPv4 address with a specific value.

This action will break any existing connections to this machine.
You will need to reconnect to this machine using the new IP address.
You may also need to flush your DNS cache.

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
    protected const PATH = '/device/{deviceId}/ip';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

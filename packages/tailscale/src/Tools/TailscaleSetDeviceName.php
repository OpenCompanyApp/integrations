<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set device name.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/name.
 */
class TailscaleSetDeviceName extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_device_name';
    protected const DESCRIPTION = 'Set device name

Official Tailscale endpoint: POST /device/{deviceId}/name

When a device is added to a tailnet, its Tailscale [device name](https://tailscale.com/kb/1098/machine-names) (also sometimes referred to as machine name) is generated from its OS hostname.
The device name is the canonical name for the device on your tailnet.

Device name changes immediately get propogated through your tailnet, so be aware that any existing [Magic DNS](https://tailscale.com/kb/1081/magicdns) URLs using the old name will no longer work.

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
    protected const PATH = '/device/{deviceId}/name';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

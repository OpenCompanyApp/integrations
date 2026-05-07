<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Authorize device.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/authorized.
 */
class TailscaleAuthorizeDevice extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_authorize_device';
    protected const DESCRIPTION = 'Authorize device

Official Tailscale endpoint: POST /device/{deviceId}/authorized

This call marks a device as authorized or revokes its authorization for tailnets where device authorization is required,
according to the authorized field in the payload.

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
    protected const PATH = '/device/{deviceId}/authorized';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

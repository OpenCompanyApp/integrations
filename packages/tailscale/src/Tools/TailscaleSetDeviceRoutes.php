<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set device routes.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/routes.
 */
class TailscaleSetDeviceRoutes extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_device_routes';
    protected const DESCRIPTION = 'Set device routes

Official Tailscale endpoint: POST /device/{deviceId}/routes

Set a device\'s enabled subnet routes by replacing the existing list of subnet routes with the supplied parameters.
[Advertised routes](/kb/1019/subnets#advertise-subnet-routes) cannot be set through the API, since they must be set directly on the device.

Routes must be both advertised and enabled for a device to act as a subnet router or exit node.
If a device has advertised routes, they are not exposed to traffic until they are enabled.
Conversely, if routes are enabled before they are advertised, they are not available for routing until the device in question has advertised them.

Learn more about [subnet routers](/kb/1019/subnets) and [exit nodes](/kb/1103/exit-nodes).

OAuth Scope: `devices:routes`.';
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
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/device/{deviceId}/routes';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

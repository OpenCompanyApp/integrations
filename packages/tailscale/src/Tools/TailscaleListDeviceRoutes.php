<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * List device routes.
 *
 * Maps to the official Tailscale endpoint get /device/{deviceId}/routes.
 */
class TailscaleListDeviceRoutes extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_list_device_routes';
    protected const DESCRIPTION = 'List device routes

Official Tailscale endpoint: GET /device/{deviceId}/routes

Retrieve the list of subnet routes that a device is advertising,
as well as those that are enabled for it.

Routes must be both advertised and enabled for a device to act as a subnet router or exit node.
If a device has advertised routes, they are not exposed to traffic until they are enabled.
Conversely, if routes are enabled before they are advertised, they are not available for routing until the device in question has advertised them.

Learn more about [subnet routers](/kb/1019/subnets) and [exit nodes](/kb/1103/exit-nodes).

OAuth Scope: `devices:routes:read`.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/device/{deviceId}/routes';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

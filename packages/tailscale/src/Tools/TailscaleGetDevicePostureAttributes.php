<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get device posture attributes.
 *
 * Maps to the official Tailscale endpoint get /device/{deviceId}/attributes.
 */
class TailscaleGetDevicePostureAttributes extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_device_posture_attributes';
    protected const DESCRIPTION = 'Get device posture attributes

Official Tailscale endpoint: GET /device/{deviceId}/attributes

Retrieve all posture attributes for the specified device.
This returns a JSON object of all the key-value pairs of posture attributes for the device.

OAuth Scope: `devices:posture_attributes:read`.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/device/{deviceId}/attributes';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

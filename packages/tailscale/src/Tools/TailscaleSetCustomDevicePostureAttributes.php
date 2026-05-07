<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set custom device posture attributes.
 *
 * Maps to the official Tailscale endpoint post /device/{deviceId}/attributes/{attributeKey}.
 */
class TailscaleSetCustomDevicePostureAttributes extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_custom_device_posture_attributes';
    protected const DESCRIPTION = 'Set custom device posture attributes

Official Tailscale endpoint: POST /device/{deviceId}/attributes/{attributeKey}

Create or update a custom posture attribute on the specified device.
User-managed attributes must be in the custom namespace,
which is indicated by prefixing the attribute key with `custom:`.

OAuth Scope: `devices:posture_attributes`.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
  'attribute_key' =>
  array (
    'type' => 'string',
    'description' => 'The name of the posture attribute to set.
This must be prefixed with `custom`:

Keys have a maximum length of 128 characters including the namespace,
and can only contain letters, numbers, underscores, and colon.

Keys are case-sensitive. Keys must be unique,
but are checked for uniqueness in a case-insensitive manner.
For example, `custom:MyAttribute` and `custom:myattribute` cannot both be set within a single tailnet.

All values for a given key need to be of the same type,
which is determined when the first value is written for a given key.
For example, `custom:myattribute` cannot have a numeric value (`87`) for one node and a string value (`"78"`)
for another node within the same tailnet.',
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
    protected const PATH = '/device/{deviceId}/attributes/{attributeKey}';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
  'attributeKey' => 'attribute_key',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

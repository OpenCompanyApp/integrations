<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get a device.
 *
 * Maps to the official Tailscale endpoint get /device/{deviceId}.
 */
class TailscaleGetDevice extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_device';
    protected const DESCRIPTION = 'Get a device

Official Tailscale endpoint: GET /device/{deviceId}

Retrieve the details for the specified device.

OAuth Scope: `devices:core:read`.';
    protected const PARAMETERS = array (
  'device_id' =>
  array (
    'type' => 'string',
    'description' => 'ID of the device. Using the device\'s `nodeId` is preferred, but its numeric `id` value can also be used.',
    'required' => true,
  ),
  'fields' =>
  array (
    'type' => 'string',
    'description' => 'Optionally controls whether the response returns **all** fields or only a predefined subset of fields.
Currently, there are two supported options:

- **`all`:** return all fields in the response
- **`default`:** return the following fields
  - `addresses`
  - `id`
  - `nodeId`
  - `user`
  - `name`
  - `hostname`
  - `clientVersion`
  - `updateAvailable`
  - `os`
  - `created`
  - `connectedToControl`
  - `lastSeen`
  - `keyExpiryDisabled`
  - `expires`
  - `authorized`
  - `isExternal`
  - `machineKey`
  - `nodeKey`
  - `blocksIncomingConnections`
  - `tailnetLockKey`
  - `tailnetLockError`
  - `tags`
  - `isEphemeral`

If the `fields` parameter is not supplied, then the default (limited fields) option is used.',
    'enum' =>
    array (
      0 => 'all',
      1 => 'default',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/device/{deviceId}';
    protected const PATH_PARAMS = array (
  'deviceId' => 'device_id',
);
    protected const QUERY_PARAMS = array (
  'fields' => 'fields',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

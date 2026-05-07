<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * List tailnet devices.
 *
 * Maps to the official Tailscale endpoint get /tailnet/{tailnet}/devices.
 */
class TailscaleListTailnetDevices extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_list_tailnet_devices';
    protected const DESCRIPTION = 'List tailnet devices

Official Tailscale endpoint: GET /tailnet/{tailnet}/devices

Lists the devices in a tailnet.

OAuth Scope: `devices:core:read`.';
    protected const PARAMETERS = array (
  'tailnet' =>
  array (
    'type' => 'string',
    'description' => 'The tailnet ID.

Tailnets created before Oct 2025 can still use the legacy ID, but the Tailnet ID is the preferred identifier.

When specifying a tailnet in the API, you can:

- Provide a dash (`-`) to reference the default tailnet of the access token being used to make the API call.
  This is the best option for most users.
  Your API calls would start:

  ```sh
  curl "https://api.tailscale.com/api/v2/tailnet/-/..."
  ```

- Provide the **tailnet ID** found on the **[General Settings](https://login.tailscale.com/admin/settings/general)**
  page of the Tailscale admin console.

  For example, if your tailnet ID name is `T1234CNTRL`, your API calls would start:

  ```sh
  curl "https://api.tailscale.com/api/v2/tailnet/T1234CNTRL/..."
  ```

  Learn more about [tailnet ID](https://tailscale.com/kb/1217/tailnet-name#tailnet-id).',
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
  'field_value_filters' =>
  array (
    'type' => 'string',
    'description' => 'This endpoint supports server-side filtering of devices by specifying one
or more filters in the form `=`. Fields must be a top-level
device property - e.g. `isEphemeral`, `tags`, `hostname`, etc. Values are
matched as _exact_ matches. Properties with simple types (strings, numbers,
dates, etc) and lists are supported. Properties that are complex objects
(e.g. `clientConnectivity`) are not supported. When multiple parameters are
provided, the server performs a logical `AND` across all filter parameters
before returning results. For example,
`isEphemeral=true&tags=tag:prod&tags=tag:subnetrouter` would return devices
where `isEphemeral` is `true` and `tags` contains both `tag:prod` and
`tag:subnetrouter`.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tailnet/{tailnet}/devices';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
  'fields' => 'fields',
  '<field>=<value> filters' => 'field_value_filters',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

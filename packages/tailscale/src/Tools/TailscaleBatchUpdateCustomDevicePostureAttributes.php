<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Batch update custom device posture attributes.
 *
 * Maps to the official Tailscale endpoint patch /tailnet/{tailnet}/device-attributes.
 */
class TailscaleBatchUpdateCustomDevicePostureAttributes extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_batch_update_custom_device_posture_attributes';
    protected const DESCRIPTION = 'Batch update custom device posture attributes

Official Tailscale endpoint: PATCH /tailnet/{tailnet}/device-attributes

Batch updates posture attributes across devices in a tailnet.

This endpoint uses [JSON Merge Patch](https://datatracker.ietf.org/doc/html/rfc7396) semantics.
Specifying `null` for an attribute will delete that attribute.

Attributes must be in the `custom:` namespace.

OAuth Scope: `devices:posture_attributes`.';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/tailnet/{tailnet}/device-attributes';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

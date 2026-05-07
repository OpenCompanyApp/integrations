<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set key.
 *
 * Maps to the official Tailscale endpoint put /tailnet/{tailnet}/keys/{keyId}.
 */
class TailscaleSetKey extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_key';
    protected const DESCRIPTION = 'Set key

Official Tailscale endpoint: PUT /tailnet/{tailnet}/keys/{keyId}

Set the configuration for an existing OAuth client or federated identity.

OAuth Scope: `oauth_keys` grants access to OAuth clients.

OAuth Scope: `federated_keys` grants access to federated identities.';
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
  'key_id' =>
  array (
    'type' => 'string',
    'description' => 'The id of the key.
The key ID can be found in the [admin console](https://login.tailscale.com/admin/settings/keys).',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'The supported fields vary depending on the value of the `keyType` field.',
  ),
);
    protected const METHOD = 'put';
    protected const PATH = '/tailnet/{tailnet}/keys/{keyId}';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
  'keyId' => 'key_id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

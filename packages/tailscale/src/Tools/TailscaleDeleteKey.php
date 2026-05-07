<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Delete key.
 *
 * Maps to the official Tailscale endpoint delete /tailnet/{tailnet}/keys/{keyId}.
 */
class TailscaleDeleteKey extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_delete_key';
    protected const DESCRIPTION = 'Delete key

Official Tailscale endpoint: DELETE /tailnet/{tailnet}/keys/{keyId}

Deletes a specific api access token or auth key.

OAuth Scope: `api_access_tokens` grants access to personal API access tokens.

OAuth Scope: `auth_keys` grants access to machine auth keys.

OAuth Scope: `oauth_keys` grants access to OAuth clients and OAuth tokens.

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
);
    protected const METHOD = 'delete';
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

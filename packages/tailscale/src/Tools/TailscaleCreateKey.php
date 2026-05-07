<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Create an auth key or trust credential.
 *
 * Maps to the official Tailscale endpoint post /tailnet/{tailnet}/keys.
 */
class TailscaleCreateKey extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_create_key';
    protected const DESCRIPTION = 'Create an auth key or trust credential

Official Tailscale endpoint: POST /tailnet/{tailnet}/keys

Creates a new [auth key](https://tailscale.com/kb/1085/), or [trust credential](https://tailscale.com/kb/1623/) in the specified tailnet.
Trust credentials include [OAuth clients](https://tailscale.com/kb/1215/) and [federated identities](https://tailscale.com/kb/1581/).
The key will be associated with the user who owns the API access token used to make this call,
or, if the call is made with an access token derived from an OAuth client or federated identity, the key will be owned by the tailnet.

Returns a JSON object with the generated key.
The key should be recorded and kept safe and secure because it wields the capabilities or scopes specified in the request.
The identity of the key is embedded in the key itself and can be used to perform operations on the key (e.g., revoking it or retrieving information about it).
The full key can no longer be retrieved after the initial response.

OAuth Scope: `auth_keys` grants access to create machine auth keys.

OAuth Scope: `oauth_keys` grants access to create OAuth clients.

OAuth Scope: `federated_keys` grants access to created federated identities.';
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
    'description' => 'The supported fields vary depending on the value of the `keyType` field.

For auth keys, at a minimum, the request POST body must have a `capabilities` object with a `devices` object,
though it can be an empty JSON object.
With nothing else supplied, such a request generates a single-use key with no tags.

For OAuth clients, at a minimum the request POST body must have at least one scope.

For federated identities, at a minimum the request POST body must have at least one scope, a valid issuer, and a subject.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/tailnet/{tailnet}/keys';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

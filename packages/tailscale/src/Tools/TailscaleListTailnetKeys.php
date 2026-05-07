<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * List tailnet keys.
 *
 * Maps to the official Tailscale endpoint get /tailnet/{tailnet}/keys.
 */
class TailscaleListTailnetKeys extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_list_tailnet_keys';
    protected const DESCRIPTION = 'List tailnet keys

Official Tailscale endpoint: GET /tailnet/{tailnet}/keys

Returns a list of active auth keys, API access tokens and trust credentials.

If the parameter {all} was not specified, the set of keys returned depends on the access token used to make the request:
- If the API call is made with a user-owned API access token, this returns only the keys owned by that user.
- If the API call is made with an access token derived from an OAuth client, this returns all OAuth clients for the tailnet.
- If the API call is made with an access token derived from a federated identity, this returns all federated identities for the tailnet.

OAuth Scope: `api_access_tokens:read` grants access to personal API access tokens.

OAuth Scope: `auth_keys:read` grants access to machine auth keys.

OAuth Scope: `oauth_keys:read` grants access to OAuth clients and OAuth tokens.

OAuth Scope: `federated_keys:read` grants access to federated identities.';
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
  'all' =>
  array (
    'type' => 'boolean',
    'description' => 'If set to true, this will return all auth keys, API access tokens and OAuth clients for the tailnet.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tailnet/{tailnet}/keys';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
  'all' => 'all',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

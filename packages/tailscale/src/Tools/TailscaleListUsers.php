<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * List users.
 *
 * Maps to the official Tailscale endpoint get /tailnet/{tailnet}/users.
 */
class TailscaleListUsers extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_list_users';
    protected const DESCRIPTION = 'List users

Official Tailscale endpoint: GET /tailnet/{tailnet}/users

List all users of a tailnet.

OAuth Scope: `users:read`.';
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
  'type' =>
  array (
    'type' => 'string',
    'description' => 'Allows for filtering the output by user type.',
    'enum' =>
    array (
      0 => 'member',
      1 => 'shared',
      2 => 'all',
    ),
  ),
  'role' =>
  array (
    'type' => 'string',
    'description' => 'Allows for filtering the output by user role. Learn more about [user roles](kb/1138/user-roles).',
    'enum' =>
    array (
      0 => 'owner',
      1 => 'member',
      2 => 'admin',
      3 => 'it-admin',
      4 => 'network-admin',
      5 => 'billing-admin',
      6 => 'auditor',
      7 => 'all',
    ),
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tailnet/{tailnet}/users';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
  'type' => 'type',
  'role' => 'role',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

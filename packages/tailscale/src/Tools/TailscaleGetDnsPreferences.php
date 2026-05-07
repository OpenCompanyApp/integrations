<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get DNS preferences.
 *
 * Maps to the official Tailscale endpoint get /tailnet/{tailnet}/dns/preferences.
 */
class TailscaleGetDnsPreferences extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_dns_preferences';
    protected const DESCRIPTION = 'Get DNS preferences

Official Tailscale endpoint: GET /tailnet/{tailnet}/dns/preferences

Retrieves the DNS preferences that are currently set for the given tailnet.';
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
);
    protected const METHOD = 'get';
    protected const PATH = '/tailnet/{tailnet}/dns/preferences';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

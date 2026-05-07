<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set DNS configuration.
 *
 * Maps to the official Tailscale endpoint post /tailnet/{tailnet}/dns/configuration.
 */
class TailscaleSetDnsConfiguration extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_dns_configuration';
    protected const DESCRIPTION = 'Set DNS configuration

Official Tailscale endpoint: POST /tailnet/{tailnet}/dns/configuration

Replaces the DNS configuration for the given tailnet.

- `nameservers` defines the global resolvers to use when `preferences.overrideLocalDNS` is true.
- `splitDNS` maps DNS name suffixes (domains) to lists of resolvers for Split DNS.
- `searchPaths` sets custom DNS search domain paths.
- `preferences.overrideLocalDNS` controls whether resolvers in `nameservers` override the local OS configuration (true) or are used or local resolvers are used (false). Defaults to false.
- `preferences.magicDNS` enables MagicDNS. Defaults to false.';
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
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/tailnet/{tailnet}/dns/configuration';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set split DNS.
 *
 * Maps to the official Tailscale endpoint put /tailnet/{tailnet}/dns/split-dns.
 */
class TailscaleSetSplitDns extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_split_dns';
    protected const DESCRIPTION = 'Set split DNS

Official Tailscale endpoint: PUT /tailnet/{tailnet}/dns/split-dns

Replaces the split DNS settings for a given tailnet.
Setting the value of a mapping to `null` clears the nameservers for that domain.
Sending an empty object clears nameservers for all domains.';
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
    protected const METHOD = 'put';
    protected const PATH = '/tailnet/{tailnet}/dns/split-dns';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Update tailnet settings.
 *
 * Maps to the official Tailscale endpoint patch /tailnet/{tailnet}/settings.
 */
class TailscaleUpdateTailnetSettings extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_update_tailnet_settings';
    protected const DESCRIPTION = 'Update tailnet settings

Official Tailscale endpoint: PATCH /tailnet/{tailnet}/settings

Update the settings for a specific tailnet.

OAuth Scope: `feature_settings` - required to update all settings except those governed by the below scopes.

OAuth Scope: `logs:network` - required to update the `networkFlowLoggingOn` setting.

OAuth Scope: `networking_settings` - required to update the `httpsCertificates` setting.

OAuth Scope: `policy_file` - required to update the `aclsExternallyManagedOn` & `aclsExternalLink` settings.';
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
    protected const METHOD = 'patch';
    protected const PATH = '/tailnet/{tailnet}/settings';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

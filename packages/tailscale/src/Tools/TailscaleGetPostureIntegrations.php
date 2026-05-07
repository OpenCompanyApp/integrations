<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * List all posture integrations.
 *
 * Maps to the official Tailscale endpoint get /tailnet/{tailnet}/posture/integrations.
 */
class TailscaleGetPostureIntegrations extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_posture_integrations';
    protected const DESCRIPTION = 'List all posture integrations

Official Tailscale endpoint: GET /tailnet/{tailnet}/posture/integrations

List all of the posture integrations for a tailnet.

OAuth Scope: `feature_settings:read`.';
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
    protected const PATH = '/tailnet/{tailnet}/posture/integrations';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

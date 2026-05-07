<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Create a posture integration.
 *
 * Maps to the official Tailscale endpoint post /tailnet/{tailnet}/posture/integrations.
 */
class TailscaleCreatePostureIntegration extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_create_posture_integration';
    protected const DESCRIPTION = 'Create a posture integration

Official Tailscale endpoint: POST /tailnet/{tailnet}/posture/integrations

Create a posture integration, returning the resulting [PostureIntegration](#model/postureintegration).

Must include `provider` and `clientSecret`.

Currently, only one integration for each provider is supported.

OAuth Scope: `feature_settings`.';
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

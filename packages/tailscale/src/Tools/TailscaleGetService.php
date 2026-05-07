<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get a Service.
 *
 * Maps to the official Tailscale endpoint get /tailnet/{tailnet}/services/{serviceName}.
 */
class TailscaleGetService extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_service';
    protected const DESCRIPTION = 'Get a Service

Official Tailscale endpoint: GET /tailnet/{tailnet}/services/{serviceName}

Retrieve the details for the specified Service.

OAuth Scope: `services:read`.';
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
  'service_name' =>
  array (
    'type' => 'string',
    'description' => 'The unique name of a Service. The name should be prefixed with "svc:". It should be unique
across the tailnet, so names already used for a machine cannot be reused for a Service.',
    'required' => true,
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tailnet/{tailnet}/services/{serviceName}';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
  'serviceName' => 'service_name',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Create or get AWS external id.
 *
 * Maps to the official Tailscale endpoint post /tailnet/{tailnet}/aws-external-id.
 */
class TailscaleGetAwsExternalId extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_aws_external_id';
    protected const DESCRIPTION = 'Create or get AWS external id

Official Tailscale endpoint: POST /tailnet/{tailnet}/aws-external-id

Get an AWS external id to use for streaming tailnet logs to S3 using role-based authentication,
creating a new one for this tailnet when necessary.

OAuth Scope: `log_streaming`.';
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
    protected const PATH = '/tailnet/{tailnet}/aws-external-id';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

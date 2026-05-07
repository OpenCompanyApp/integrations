<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Disable log streaming.
 *
 * Maps to the official Tailscale endpoint delete /tailnet/{tailnet}/logging/{logType}/stream.
 */
class TailscaleDisableLogStreaming extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_disable_log_streaming';
    protected const DESCRIPTION = 'Disable log streaming

Official Tailscale endpoint: DELETE /tailnet/{tailnet}/logging/{logType}/stream

Delete the log streaming configuration for the provided log type.

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
  'log_type' =>
  array (
    'type' => 'string',
    'description' => 'The type of log.',
    'required' => true,
    'enum' =>
    array (
      0 => 'configuration',
      1 => 'network',
    ),
  ),
);
    protected const METHOD = 'delete';
    protected const PATH = '/tailnet/{tailnet}/logging/{logType}/stream';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
  'logType' => 'log_type',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

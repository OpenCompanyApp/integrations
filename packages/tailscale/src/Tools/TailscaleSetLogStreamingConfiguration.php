<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set log streaming configuration.
 *
 * Maps to the official Tailscale endpoint put /tailnet/{tailnet}/logging/{logType}/stream.
 */
class TailscaleSetLogStreamingConfiguration extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_log_streaming_configuration';
    protected const DESCRIPTION = 'Set log streaming configuration

Official Tailscale endpoint: PUT /tailnet/{tailnet}/logging/{logType}/stream

Set the log streaming configuration for the provided log type.

OAuth Scope: `log_streaming`. `device_invites` and `policy_file` are also required if streaming to a [private endpoint](https://tailscale.com/kb/1255/log-streaming#private-endpoints).';
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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'The [LogstreamEndpointConfiguration](#model/logstreamendpointconfiguration) to set.
`logType` is specified in the request URL rather than the body.',
  ),
);
    protected const METHOD = 'put';
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

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * List configuration audit logs.
 *
 * Maps to the official Tailscale endpoint get /tailnet/{tailnet}/logging/configuration.
 */
class TailscaleListConfigurationAuditLogs extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_list_configuration_audit_logs';
    protected const DESCRIPTION = 'List configuration audit logs

Official Tailscale endpoint: GET /tailnet/{tailnet}/logging/configuration

List all configuration audit logs for a tailnet.

OAuth Scope: `logs:configuration:read`.';
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
  'start' =>
  array (
    'type' => 'string',
    'description' => 'The start of the time window for which to retrieve logs, in RFC 3339 format.',
    'required' => true,
  ),
  'end' =>
  array (
    'type' => 'string',
    'description' => 'The end of the time window for which to retrieve logs, in RFC 3339 format.',
    'required' => true,
  ),
  'actor' =>
  array (
    'type' => 'array',
    'description' => 'List of filters on actors, either exact actor IDs or a wildcard search on login name or display name indicated as `~search`.',
  ),
  'target' =>
  array (
    'type' => 'array',
    'description' => 'List of target elements for which to filter, attempts to match any part of any of the targets to any of the given strings.',
  ),
  'event' =>
  array (
    'type' => 'array',
    'description' => 'List of events for which to filter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tailnet/{tailnet}/logging/configuration';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
  'start' => 'start',
  'end' => 'end',
  'actor' => 'actor',
  'target' => 'target',
  'event' => 'event',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

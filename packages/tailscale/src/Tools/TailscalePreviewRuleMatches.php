<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Preview rule matches.
 *
 * Maps to the official Tailscale endpoint post /tailnet/{tailnet}/acl/preview.
 */
class TailscalePreviewRuleMatches extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_preview_rule_matches';
    protected const DESCRIPTION = 'Preview rule matches

Official Tailscale endpoint: POST /tailnet/{tailnet}/acl/preview

When given a user or IP port to match against,
returns the tailnet policy rules that apply to that resource,
without saving the policy file to the server.';
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
  'type' =>
  array (
    'type' => 'string',
    'description' => 'Specify for which type of resource (user or IP port) matching rules are to be fetched.
Read about [previewing changes in the admin console](https://tailscale.com/kb/1018/#previewing-changes).

OAuth Scope: `policy_file:read`.',
    'required' => true,
    'enum' =>
    array (
      0 => 'user',
      1 => 'ipport',
    ),
  ),
  'preview_for' =>
  array (
    'type' => 'string',
    'description' => '- If `type` is `user`, provide the email of a valid user with registered machines.
- If `type` is `ipport`, provide an IP address + port: `10.0.0.1:80`.

The supplied policy file is queried with this parameter to determine which rules match.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/tailnet/{tailnet}/acl/preview';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
  'type' => 'type',
  'previewFor' => 'preview_for',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

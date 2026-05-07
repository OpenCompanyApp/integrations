<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Update contact.
 *
 * Maps to the official Tailscale endpoint patch /tailnet/{tailnet}/contacts/{contactType}.
 */
class TailscaleUpdateContact extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_update_contact';
    protected const DESCRIPTION = 'Update contact

Official Tailscale endpoint: PATCH /tailnet/{tailnet}/contacts/{contactType}

Update the preferences for this type of contact. If the email address has changed, the system will send a verification email to confirm the change.

OAuth Scope: `account_settings`.';
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
  'contact_type' =>
  array (
    'type' => 'string',
    'description' => 'Type of contact.',
    'required' => true,
    'enum' =>
    array (
      0 => 'account',
      1 => 'support',
      2 => 'security',
    ),
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'patch';
    protected const PATH = '/tailnet/{tailnet}/contacts/{contactType}';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
  'contactType' => 'contact_type',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Resend verification email.
 *
 * Maps to the official Tailscale endpoint post /tailnet/{tailnet}/contacts/{contactType}/resend-verification-email.
 */
class TailscaleResendContactVerificationEmail extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_resend_contact_verification_email';
    protected const DESCRIPTION = 'Resend verification email

Official Tailscale endpoint: POST /tailnet/{tailnet}/contacts/{contactType}/resend-verification-email

Resends the verification email for this contact, if and only if verification is still pending.

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
);
    protected const METHOD = 'post';
    protected const PATH = '/tailnet/{tailnet}/contacts/{contactType}/resend-verification-email';
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

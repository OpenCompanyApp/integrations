<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Get policy file.
 *
 * Maps to the official Tailscale endpoint get /tailnet/{tailnet}/acl.
 */
class TailscaleGetPolicyFile extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_get_policy_file';
    protected const DESCRIPTION = 'Get policy file

Official Tailscale endpoint: GET /tailnet/{tailnet}/acl

Retrieves the current policy file for the given tailnet;
this includes the ACL along with the rules and tests that have been defined.

This method can return the policy file as JSON or HuJSON, depending on the Accept header.
The response also includes an `ETag` header, which can be optionally included when [setting the policy file](#tag/policyfile/post/tailnet/{tailnet}/acl) to avoid missed updates.

Learn more about [policy file ACL syntax](https://tailscale.com/kb/1337/acl-syntax).

OAuth Scope: `policy_file:read`.';
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
  'accept' =>
  array (
    'type' => 'string',
    'description' => 'Response is encoded as JSON if `application/json` is requested, otherwise HuJSON will be returned.',
  ),
  'details' =>
  array (
    'type' => 'boolean',
    'description' => 'Request a detailed description of the tailnet policy file by providing `details=true` in the URL query string.
Supplying any other value for `details`, or not sending the param, is treated as sending `details=false`.
If using this, do not supply an `Accept` parameter in the header.

The response will contain a JSON object with the fields:
- `acl`: a base64-encoded string representation of the huJSON format.
- `warnings`: array of strings for syntactically valid but nonsensical entries.
- `errors`: an array of strings for parsing failures.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/tailnet/{tailnet}/acl';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
  'details' => 'details',
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
);
    protected const BODY_REQUIRED = false;
}

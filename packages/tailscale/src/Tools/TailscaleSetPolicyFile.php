<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Set policy file.
 *
 * Maps to the official Tailscale endpoint post /tailnet/{tailnet}/acl.
 */
class TailscaleSetPolicyFile extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_set_policy_file';
    protected const DESCRIPTION = 'Set policy file

Official Tailscale endpoint: POST /tailnet/{tailnet}/acl

Sets the ACL for the given tailnet. HuJSON and JSON are both accepted inputs.
An `If-Match` header can be set to avoid missed updates.

On success, returns the updated ACL in JSON or HuJSON according to the `Accept` header.
Otherwise, errors are returned for incorrectly defined ACLs, ACLs with failing tests on attempted updates, and mismatched `If-Match` header and `ETag`.

Learn more about [policy file ACL syntax](https://tailscale.com/kb/1337/acl-syntax).

OAuth Scope: `policy_file`.';
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
  'if_match' =>
  array (
    'type' => 'string',
    'description' => 'This is a safety mechanism to avoid overwriting other users\' updates to the tailnet policy file.

- Set the `If-Match` value to that of the `ETag` header returned in a `GET` request to `/api/v2/tailnet/{tailnet}/acl`.
  Tailscale compares the `ETag` value in your request to that of the current tailnet file and only replaces the file if there\'s a match.
  (A mismatch indicates that another update has been made to the file.) For example: `-H "If-Match: \\"e0b2816b418\\""`.
- Alternately, set the `If-Match` value to `ts-default` to ensure that the policy file is replaced *only if the current policy file is still the untouched default created automatically* for each tailnet.
  For example: `-H "If-Match: \\"ts-default\\""`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/tailnet/{tailnet}/acl';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
  'Accept' => 'accept',
  'If-Match' => 'if_match',
);
    protected const BODY_REQUIRED = false;
}

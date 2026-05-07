<?php

namespace OpenCompany\Integrations\Tailscale\Tools;

/**
 * Validate and test policy file.
 *
 * Maps to the official Tailscale endpoint post /tailnet/{tailnet}/acl/validate.
 */
class TailscaleValidateAndTestPolicyFile extends AbstractTailscaleTool
{
    protected const NAME = 'tailscale_validate_and_test_policy_file';
    protected const DESCRIPTION = 'Validate and test policy file

Official Tailscale endpoint: POST /tailnet/{tailnet}/acl/validate

This endpoint works in one of two modes, neither of which modifies your current tailnet policy file:

- Run ACL tests: When the request body contains ACL tests as a JSON array,
  Tailscale runs ACL tests against the tailnet\'s current policy file.
  Learn more about [ACL tests](https://tailscale.com/kb/1337/acl-syntax#tests).
- Validate a new policy file: When the request body is a JSON object,
  Tailscale interprets the body as a hypothetical new tailnet policy file with new ACLs,
  including any new rules and tests.
  It validates that the policy file is parsable and runs tests to validate the existing rules.

In either case, this method does not modify the tailnet policy file in any way.

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
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON request body matching the Tailscale API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/tailnet/{tailnet}/acl/validate';
    protected const PATH_PARAMS = array (
  'tailnet' => 'tailnet',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

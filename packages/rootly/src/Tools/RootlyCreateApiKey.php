<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Creates an API key.
 *
 * Maps to the official Rootly endpoint post /v1/api_keys.
 */
class RootlyCreateApiKey extends AbstractRootlyTool
{
    protected const NAME = 'rootly_create_api_key';
    protected const DESCRIPTION = 'Creates an API key

Official Rootly endpoint: POST /v1/api_keys

Creates a new API key and returns it with the plaintext token. **The token is only returned once** — store it securely, as it cannot be retrieved again.

**Kinds and required fields:**
- `personal` — created for the authenticated user. No additional fields required.
- `team` — scoped to a team (group). Requires `group_id`. A service account is automatically created with permissions derived from group membership.
- `organization` — organization-wide access. Requires owner or admin role. Optionally set `role_id` and `on_call_role_id` to control the service account\'s permissions.

**Expiration:** All keys require an `expires_at` date set in the future (maximum 5 years). Names must be unique within their kind and scope.';
    protected const PARAMETERS = array (
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
    'required' => true,
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/api_keys';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = true;
}

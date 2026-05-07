<?php

namespace OpenCompany\Integrations\Rootly\Tools;

/**
 * Rotate an API key.
 *
 * Maps to the official Rootly endpoint post /v1/api_keys/{id}/rotate.
 */
class RootlyRotateApiKey extends AbstractRootlyTool
{
    protected const NAME = 'rootly_rotate_api_key';
    protected const DESCRIPTION = 'Rotate an API key

Official Rootly endpoint: POST /v1/api_keys/{id}/rotate

Rotate an API key\'s token. Issues a new secret token and returns it — **the new token is only shown once**, so store it securely.

**Self-only:** You can only rotate the API key that was used to authenticate this request. Attempting to rotate a different key returns `403 Forbidden`.

**Grace period:** When enabled for your organization, the previous token remains valid after rotation, giving you time to deploy the new token without downtime. Pass `grace_period_minutes` (integer, 0–1440, default 30) to control how long the old token stays valid. Set to 0 to immediately invalidate the old token. The `grace_period_ends_at` field in the response confirms the exact time the old token will stop working.

**Expiration:** Optionally provide a new `expires_at` date (ISO 8601, up to 5 years). Defaults to 90 days from now if omitted. Dates in the past are rejected.

**Typical rotation workflow:**
1. Call this endpoint to get a new token (optionally with a custom `grace_period_minutes`).
2. Deploy the new token to your systems.
3. The old token continues working for `grace_period_minutes` (if grace period is enabled).
4. After the grace period, the old token is automatically invalidated.';
    protected const PARAMETERS = array (
  'id' =>
  array (
    'type' => 'string',
    'description' => 'id parameter.',
    'required' => true,
  ),
  'body' =>
  array (
    'type' => 'object',
    'description' => 'JSON:API request body matching the Rootly API schema.',
  ),
);
    protected const METHOD = 'post';
    protected const PATH = '/v1/api_keys/{id}/rotate';
    protected const PATH_PARAMS = array (
  'id' => 'id',
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

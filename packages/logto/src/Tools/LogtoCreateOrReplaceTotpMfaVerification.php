<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create or replace the authenticator app.
 *
 * Maps to PUT /api/my-account/mfa-verifications/totp in the official Logto OpenAPI source.
 */
class LogtoCreateOrReplaceTotpMfaVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_or_replace_totp_mfa_verification',
  'class' => 'LogtoCreateOrReplaceTotpMfaVerification',
  'method' => 'PUT',
  'path' => '/api/my-account/mfa-verifications/totp',
  'operation_id' => 'CreateOrReplaceTotpMfaVerification',
  'summary' => 'Create or replace the authenticator app',
  'description' => 'Create or replace the user\'s TOTP MFA verification with a new authenticator app binding. If the user already has a TOTP verification, it will be replaced; otherwise, a new one will be created. Requires a logto-verification-id header for sensitive permission checks, a valid TOTP secret, and a valid TOTP code generated from the secret.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

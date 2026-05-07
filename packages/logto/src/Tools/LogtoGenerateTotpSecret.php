<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Generate a TOTP secret.
 *
 * Maps to POST /api/my-account/mfa-verifications/totp-secret/generate in the official Logto OpenAPI source.
 */
class LogtoGenerateTotpSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_generate_totp_secret',
  'class' => 'LogtoGenerateTotpSecret',
  'method' => 'POST',
  'path' => '/api/my-account/mfa-verifications/totp-secret/generate',
  'operation_id' => 'GenerateTotpSecret',
  'summary' => 'Generate a TOTP secret',
  'description' => 'Generate a TOTP secret for the user.',
  'parameters' =>
  array (
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}

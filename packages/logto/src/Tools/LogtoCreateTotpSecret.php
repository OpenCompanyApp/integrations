<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create TOTP secret.
 *
 * Maps to POST /api/experience/verification/totp/secret in the official Logto OpenAPI source.
 */
class LogtoCreateTotpSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_totp_secret',
  'class' => 'LogtoCreateTotpSecret',
  'method' => 'POST',
  'path' => '/api/experience/verification/totp/secret',
  'operation_id' => 'CreateTotpSecret',
  'summary' => 'Create TOTP secret',
  'description' => 'Create a new TOTP verification record and generate a new TOTP secret for the user. This secret can be used to bind a new TOTP verification to the user\'s profile. The verification record must be verified before the secret can be used to bind a new TOTP verification to the user\'s profile.',
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

<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create passkey sign-in WebAuthn authentication.
 *
 * Maps to POST /api/experience/preflight/sign-in-passkey/authentication in the official Logto OpenAPI source.
 */
class LogtoCreateSignInPasskeyAuthentication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_sign_in_passkey_authentication',
  'class' => 'LogtoCreateSignInPasskeyAuthentication',
  'method' => 'POST',
  'path' => '/api/experience/preflight/sign-in-passkey/authentication',
  'operation_id' => 'CreateSignInPasskeyAuthentication',
  'summary' => 'Create passkey sign-in WebAuthn authentication',
  'description' => 'Create WebAuthn authentication options for passkey sign-in. The user will be resolved later by the credential during verification.',
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

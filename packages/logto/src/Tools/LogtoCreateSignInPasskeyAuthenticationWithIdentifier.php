<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create passkey sign-in WebAuthn authentication with identifier.
 *
 * Maps to POST /api/experience/verification/sign-in-passkey/authentication in the official Logto OpenAPI source.
 */
class LogtoCreateSignInPasskeyAuthenticationWithIdentifier extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_sign_in_passkey_authentication_with_identifier',
  'class' => 'LogtoCreateSignInPasskeyAuthenticationWithIdentifier',
  'method' => 'POST',
  'path' => '/api/experience/verification/sign-in-passkey/authentication',
  'operation_id' => 'CreateSignInPasskeyAuthenticationWithIdentifier',
  'summary' => 'Create passkey sign-in WebAuthn authentication with identifier',
  'description' => 'Create WebAuthn authentication options for passkey sign-in with an identifier. The identifier is used to look up the user\'s WebAuthn credentials and generate non-discoverable authentication options.',
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

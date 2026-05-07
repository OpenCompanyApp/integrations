<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get OIDC keys.
 *
 * Maps to GET /api/configs/oidc/{keyType} in the official Logto OpenAPI source.
 */
class LogtoGetOidcKeys extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_oidc_keys',
  'class' => 'LogtoGetOidcKeys',
  'method' => 'GET',
  'path' => '/api/configs/oidc/{keyType}',
  'operation_id' => 'GetOidcKeys',
  'summary' => 'Get OIDC keys',
  'description' => 'Get OIDC signing keys by key type. The actual key will be redacted from the result.',
  'parameters' =>
  array (
    'key_type' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Private keys are used to sign OIDC JWTs. Cookie keys are used to sign OIDC cookies. For clients, they do not need to know private keys to verify OIDC JWTs; they can use public keys from the JWKS endpoint instead.',
      'enum' =>
      array (
        0 => 'private-keys',
        1 => 'cookie-keys',
      ),
    ),
  ),
  'path_params' =>
  array (
    'keyType' => 'key_type',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}

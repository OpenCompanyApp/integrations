<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Rotate OIDC keys.
 *
 * Maps to POST /api/configs/oidc/{keyType}/rotate in the official Logto OpenAPI source.
 */
class LogtoRotateOidcKeys extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_rotate_oidc_keys',
  'class' => 'LogtoRotateOidcKeys',
  'method' => 'POST',
  'path' => '/api/configs/oidc/{keyType}/rotate',
  'operation_id' => 'RotateOidcKeys',
  'summary' => 'Rotate OIDC keys',
  'description' => 'A new key will be generated and prepend to the list of keys. Only two recent keys will be kept. The oldest key will be automatically removed if there are more than two keys.',
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
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}

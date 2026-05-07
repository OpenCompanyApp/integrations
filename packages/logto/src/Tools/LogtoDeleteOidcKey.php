<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete OIDC key.
 *
 * Maps to DELETE /api/configs/oidc/{keyType}/{keyId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOidcKey extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_oidc_key',
  'class' => 'LogtoDeleteOidcKey',
  'method' => 'DELETE',
  'path' => '/api/configs/oidc/{keyType}/{keyId}',
  'operation_id' => 'DeleteOidcKey',
  'summary' => 'Delete OIDC key',
  'description' => 'Delete an OIDC signing key by key type and key ID.',
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
    'key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the key.',
    ),
  ),
  'path_params' =>
  array (
    'keyType' => 'key_type',
    'keyId' => 'key_id',
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

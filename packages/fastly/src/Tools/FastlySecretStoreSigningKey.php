<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get public key
 *
 * Maps to Fastly generated client operation SecretStoreApi::signingKey (GET /resources/stores/secret/signing-key).
 */
class FastlySecretStoreSigningKey extends AbstractFastlyTool
{
    protected const NAME = 'fastly_secret_store_signing_key';
    protected const DESCRIPTION = 'Get public key

Official Fastly client operation: SecretStoreApi::signingKey
Endpoint: GET /resources/stores/secret/signing-key

Get public key';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_secret_store_signing_key',
  'class' => 'FastlySecretStoreSigningKey',
  'api_class' => 'SecretStoreApi',
  'method_name' => 'signingKey',
  'method' => 'GET',
  'path' => '/resources/stores/secret/signing-key',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get public key',
  'description' => 'Get public key',
  'type' => 'read',
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
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

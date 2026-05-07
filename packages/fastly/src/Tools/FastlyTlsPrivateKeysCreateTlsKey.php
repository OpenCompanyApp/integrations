<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a TLS private key
 *
 * Maps to Fastly generated client operation TlsPrivateKeysApi::createTlsKey (POST /tls/private_keys).
 */
class FastlyTlsPrivateKeysCreateTlsKey extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_private_keys_create_tls_key';
    protected const DESCRIPTION = 'Create a TLS private key

Official Fastly client operation: TlsPrivateKeysApi::createTlsKey
Endpoint: POST /tls/private_keys

Create a TLS private key';
    protected const PARAMETERS = array (
  'tls_private_key' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `tls_private_key`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_private_keys_create_tls_key',
  'class' => 'FastlyTlsPrivateKeysCreateTlsKey',
  'api_class' => 'TlsPrivateKeysApi',
  'method_name' => 'createTlsKey',
  'method' => 'POST',
  'path' => '/tls/private_keys',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a TLS private key',
  'description' => 'Create a TLS private key',
  'type' => 'write',
  'parameters' =>
  array (
    'tls_private_key' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `tls_private_key`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'form_params' =>
  array (
  ),
  'body_param' => 'tls_private_key',
  'body_required' => false,
);
}

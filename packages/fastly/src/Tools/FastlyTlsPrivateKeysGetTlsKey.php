<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a TLS private key
 *
 * Maps to Fastly generated client operation TlsPrivateKeysApi::getTlsKey (GET /tls/private_keys/{tls_private_key_id}).
 */
class FastlyTlsPrivateKeysGetTlsKey extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_private_keys_get_tls_key';
    protected const DESCRIPTION = 'Get a TLS private key

Official Fastly client operation: TlsPrivateKeysApi::getTlsKey
Endpoint: GET /tls/private_keys/{tls_private_key_id}

Get a TLS private key';
    protected const PARAMETERS = array (
  'tls_private_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_private_key_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_private_keys_get_tls_key',
  'class' => 'FastlyTlsPrivateKeysGetTlsKey',
  'api_class' => 'TlsPrivateKeysApi',
  'method_name' => 'getTlsKey',
  'method' => 'GET',
  'path' => '/tls/private_keys/{tls_private_key_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a TLS private key',
  'description' => 'Get a TLS private key',
  'type' => 'read',
  'parameters' =>
  array (
    'tls_private_key_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `tls_private_key_id`.',
    ),
  ),
  'path_params' =>
  array (
    'tls_private_key_id' => 'tls_private_key_id',
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

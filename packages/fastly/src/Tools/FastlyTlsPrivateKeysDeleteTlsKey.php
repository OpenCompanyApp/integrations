<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a TLS private key
 *
 * Maps to Fastly generated client operation TlsPrivateKeysApi::deleteTlsKey (DELETE /tls/private_keys/{tls_private_key_id}).
 */
class FastlyTlsPrivateKeysDeleteTlsKey extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_private_keys_delete_tls_key';
    protected const DESCRIPTION = 'Delete a TLS private key

Official Fastly client operation: TlsPrivateKeysApi::deleteTlsKey
Endpoint: DELETE /tls/private_keys/{tls_private_key_id}

Delete a TLS private key';
    protected const PARAMETERS = array (
  'tls_private_key_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `tls_private_key_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_private_keys_delete_tls_key',
  'class' => 'FastlyTlsPrivateKeysDeleteTlsKey',
  'api_class' => 'TlsPrivateKeysApi',
  'method_name' => 'deleteTlsKey',
  'method' => 'DELETE',
  'path' => '/tls/private_keys/{tls_private_key_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a TLS private key',
  'description' => 'Delete a TLS private key',
  'type' => 'write',
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

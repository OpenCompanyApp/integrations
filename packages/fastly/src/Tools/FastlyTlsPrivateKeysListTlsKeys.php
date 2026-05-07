<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List TLS private keys
 *
 * Maps to Fastly generated client operation TlsPrivateKeysApi::listTlsKeys (GET /tls/private_keys).
 */
class FastlyTlsPrivateKeysListTlsKeys extends AbstractFastlyTool
{
    protected const NAME = 'fastly_tls_private_keys_list_tls_keys';
    protected const DESCRIPTION = 'List TLS private keys

Official Fastly client operation: TlsPrivateKeysApi::listTlsKeys
Endpoint: GET /tls/private_keys

List TLS private keys';
    protected const PARAMETERS = array (
  'filter_in_use' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter_in_use`.',
  ),
  'page_number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_number`.',
  ),
  'page_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page_size`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_tls_private_keys_list_tls_keys',
  'class' => 'FastlyTlsPrivateKeysListTlsKeys',
  'api_class' => 'TlsPrivateKeysApi',
  'method_name' => 'listTlsKeys',
  'method' => 'GET',
  'path' => '/tls/private_keys',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List TLS private keys',
  'description' => 'List TLS private keys',
  'type' => 'read',
  'parameters' =>
  array (
    'filter_in_use' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter_in_use`.',
    ),
    'page_number' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_number`.',
    ),
    'page_size' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page_size`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'filter[in_use]' => 'filter_in_use',
    'page[number]' => 'page_number',
    'page[size]' => 'page_size',
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

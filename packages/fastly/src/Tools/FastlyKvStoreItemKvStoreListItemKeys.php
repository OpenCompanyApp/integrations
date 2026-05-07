<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List item keys.
 *
 * Maps to Fastly generated client operation KvStoreItemApi::kvStoreListItemKeys (GET /resources/stores/kv/{store_id}/keys).
 */
class FastlyKvStoreItemKvStoreListItemKeys extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_item_kv_store_list_item_keys';
    protected const DESCRIPTION = 'List item keys.

Official Fastly client operation: KvStoreItemApi::kvStoreListItemKeys
Endpoint: GET /resources/stores/kv/{store_id}/keys

List item keys.';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'prefix' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `prefix`.',
  ),
  'consistency' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `consistency`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_kv_store_item_kv_store_list_item_keys',
  'class' => 'FastlyKvStoreItemKvStoreListItemKeys',
  'api_class' => 'KvStoreItemApi',
  'method_name' => 'kvStoreListItemKeys',
  'method' => 'GET',
  'path' => '/resources/stores/kv/{store_id}/keys',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List item keys.',
  'description' => 'List item keys.',
  'type' => 'read',
  'parameters' =>
  array (
    'store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `store_id`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'prefix' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `prefix`.',
    ),
    'consistency' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `consistency`.',
    ),
  ),
  'path_params' =>
  array (
    'store_id' => 'store_id',
  ),
  'query_params' =>
  array (
    'cursor' => 'cursor',
    'limit' => 'limit',
    'prefix' => 'prefix',
    'consistency' => 'consistency',
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

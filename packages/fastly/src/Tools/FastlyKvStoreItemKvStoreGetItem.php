<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an item.
 *
 * Maps to Fastly generated client operation KvStoreItemApi::kvStoreGetItem (GET /resources/stores/kv/{store_id}/keys/{key}).
 */
class FastlyKvStoreItemKvStoreGetItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_item_kv_store_get_item';
    protected const DESCRIPTION = 'Get an item.

Official Fastly client operation: KvStoreItemApi::kvStoreGetItem
Endpoint: GET /resources/stores/kv/{store_id}/keys/{key}

Get an item.';
    protected const PARAMETERS = array (
  'store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `store_id`.',
  ),
  'key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `key`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_kv_store_item_kv_store_get_item',
  'class' => 'FastlyKvStoreItemKvStoreGetItem',
  'api_class' => 'KvStoreItemApi',
  'method_name' => 'kvStoreGetItem',
  'method' => 'GET',
  'path' => '/resources/stores/kv/{store_id}/keys/{key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an item.',
  'description' => 'Get an item.',
  'type' => 'read',
  'parameters' =>
  array (
    'store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `store_id`.',
    ),
    'key' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `key`.',
    ),
  ),
  'path_params' =>
  array (
    'store_id' => 'store_id',
    'key' => 'key',
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

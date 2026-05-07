<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an item.
 *
 * Maps to Fastly generated client operation KvStoreItemApi::kvStoreDeleteItem (DELETE /resources/stores/kv/{store_id}/keys/{key}).
 */
class FastlyKvStoreItemKvStoreDeleteItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_item_kv_store_delete_item';
    protected const DESCRIPTION = 'Delete an item.

Official Fastly client operation: KvStoreItemApi::kvStoreDeleteItem
Endpoint: DELETE /resources/stores/kv/{store_id}/keys/{key}

Delete an item.';
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
  'if_generation_match' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `if_generation_match`.',
  ),
  'force' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `force`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_kv_store_item_kv_store_delete_item',
  'class' => 'FastlyKvStoreItemKvStoreDeleteItem',
  'api_class' => 'KvStoreItemApi',
  'method_name' => 'kvStoreDeleteItem',
  'method' => 'DELETE',
  'path' => '/resources/stores/kv/{store_id}/keys/{key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an item.',
  'description' => 'Delete an item.',
  'type' => 'write',
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
    'if_generation_match' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `if_generation_match`.',
    ),
    'force' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `force`.',
    ),
  ),
  'path_params' =>
  array (
    'store_id' => 'store_id',
    'key' => 'key',
  ),
  'query_params' =>
  array (
    'force' => 'force',
  ),
  'header_params' =>
  array (
    'if-generation-match' => 'if_generation_match',
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

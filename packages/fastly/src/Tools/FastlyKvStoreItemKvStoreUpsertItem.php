<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Insert or update an item.
 *
 * Maps to Fastly generated client operation KvStoreItemApi::kvStoreUpsertItem (PUT /resources/stores/kv/{store_id}/keys/{key}).
 */
class FastlyKvStoreItemKvStoreUpsertItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_kv_store_item_kv_store_upsert_item';
    protected const DESCRIPTION = 'Insert or update an item.

Official Fastly client operation: KvStoreItemApi::kvStoreUpsertItem
Endpoint: PUT /resources/stores/kv/{store_id}/keys/{key}

Insert or update an item.';
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
  'time_to_live_sec' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `time_to_live_sec`.',
  ),
  'metadata' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `metadata`.',
  ),
  'add' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `add`.',
  ),
  'append' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `append`.',
  ),
  'prepend' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `prepend`.',
  ),
  'background_fetch' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `background_fetch`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_kv_store_item_kv_store_upsert_item',
  'class' => 'FastlyKvStoreItemKvStoreUpsertItem',
  'api_class' => 'KvStoreItemApi',
  'method_name' => 'kvStoreUpsertItem',
  'method' => 'PUT',
  'path' => '/resources/stores/kv/{store_id}/keys/{key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Insert or update an item.',
  'description' => 'Insert or update an item.',
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
    'time_to_live_sec' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `time_to_live_sec`.',
    ),
    'metadata' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `metadata`.',
    ),
    'add' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `add`.',
    ),
    'append' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `append`.',
    ),
    'prepend' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `prepend`.',
    ),
    'background_fetch' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `background_fetch`.',
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
    'store_id' => 'store_id',
    'key' => 'key',
  ),
  'query_params' =>
  array (
    'add' => 'add',
    'append' => 'append',
    'prepend' => 'prepend',
    'background_fetch' => 'background_fetch',
  ),
  'header_params' =>
  array (
    'if-generation-match' => 'if_generation_match',
    'time_to_live_sec' => 'time_to_live_sec',
    'metadata' => 'metadata',
  ),
  'form_params' =>
  array (
  ),
  'body_param' => 'body',
  'body_required' => false,
);
}

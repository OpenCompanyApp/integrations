<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Insert or update an entry in a config store
 *
 * Maps to Fastly generated client operation ConfigStoreItemApi::upsertConfigStoreItem (PUT /resources/stores/config/{config_store_id}/item/{config_store_item_key}).
 */
class FastlyConfigStoreItemUpsertConfigStoreItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_item_upsert_config_store_item';
    protected const DESCRIPTION = 'Insert or update an entry in a config store

Official Fastly client operation: ConfigStoreItemApi::upsertConfigStoreItem
Endpoint: PUT /resources/stores/config/{config_store_id}/item/{config_store_item_key}

Insert or update an entry in a config store';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
  ),
  'config_store_item_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_item_key`.',
  ),
  'item_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `item_key`.',
  ),
  'item_value' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `item_value`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_item_upsert_config_store_item',
  'class' => 'FastlyConfigStoreItemUpsertConfigStoreItem',
  'api_class' => 'ConfigStoreItemApi',
  'method_name' => 'upsertConfigStoreItem',
  'method' => 'PUT',
  'path' => '/resources/stores/config/{config_store_id}/item/{config_store_item_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Insert or update an entry in a config store',
  'description' => 'Insert or update an entry in a config store',
  'type' => 'write',
  'parameters' =>
  array (
    'config_store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `config_store_id`.',
    ),
    'config_store_item_key' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `config_store_item_key`.',
    ),
    'item_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `item_key`.',
    ),
    'item_value' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `item_value`.',
    ),
  ),
  'path_params' =>
  array (
    'config_store_id' => 'config_store_id',
    'config_store_item_key' => 'config_store_item_key',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
    'item_key' => 'item_key',
    'item_value' => 'item_value',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

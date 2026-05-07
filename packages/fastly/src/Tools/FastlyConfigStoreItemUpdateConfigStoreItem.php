<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an entry in a config store
 *
 * Maps to Fastly generated client operation ConfigStoreItemApi::updateConfigStoreItem (PATCH /resources/stores/config/{config_store_id}/item/{config_store_item_key}).
 */
class FastlyConfigStoreItemUpdateConfigStoreItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_item_update_config_store_item';
    protected const DESCRIPTION = 'Update an entry in a config store

Official Fastly client operation: ConfigStoreItemApi::updateConfigStoreItem
Endpoint: PATCH /resources/stores/config/{config_store_id}/item/{config_store_item_key}

Update an entry in a config store';
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
  'slug' => 'fastly_config_store_item_update_config_store_item',
  'class' => 'FastlyConfigStoreItemUpdateConfigStoreItem',
  'api_class' => 'ConfigStoreItemApi',
  'method_name' => 'updateConfigStoreItem',
  'method' => 'PATCH',
  'path' => '/resources/stores/config/{config_store_id}/item/{config_store_item_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an entry in a config store',
  'description' => 'Update an entry in a config store',
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

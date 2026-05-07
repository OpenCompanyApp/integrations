<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an item from a config store
 *
 * Maps to Fastly generated client operation ConfigStoreItemApi::deleteConfigStoreItem (DELETE /resources/stores/config/{config_store_id}/item/{config_store_item_key}).
 */
class FastlyConfigStoreItemDeleteConfigStoreItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_item_delete_config_store_item';
    protected const DESCRIPTION = 'Delete an item from a config store

Official Fastly client operation: ConfigStoreItemApi::deleteConfigStoreItem
Endpoint: DELETE /resources/stores/config/{config_store_id}/item/{config_store_item_key}

Delete an item from a config store';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_item_delete_config_store_item',
  'class' => 'FastlyConfigStoreItemDeleteConfigStoreItem',
  'api_class' => 'ConfigStoreItemApi',
  'method_name' => 'deleteConfigStoreItem',
  'method' => 'DELETE',
  'path' => '/resources/stores/config/{config_store_id}/item/{config_store_item_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an item from a config store',
  'description' => 'Delete an item from a config store',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

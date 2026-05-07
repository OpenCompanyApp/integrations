<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an item from a config store
 *
 * Maps to Fastly generated client operation ConfigStoreItemApi::getConfigStoreItem (GET /resources/stores/config/{config_store_id}/item/{config_store_item_key}).
 */
class FastlyConfigStoreItemGetConfigStoreItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_item_get_config_store_item';
    protected const DESCRIPTION = 'Get an item from a config store

Official Fastly client operation: ConfigStoreItemApi::getConfigStoreItem
Endpoint: GET /resources/stores/config/{config_store_id}/item/{config_store_item_key}

Get an item from a config store';
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
  'slug' => 'fastly_config_store_item_get_config_store_item',
  'class' => 'FastlyConfigStoreItemGetConfigStoreItem',
  'api_class' => 'ConfigStoreItemApi',
  'method_name' => 'getConfigStoreItem',
  'method' => 'GET',
  'path' => '/resources/stores/config/{config_store_id}/item/{config_store_item_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an item from a config store',
  'description' => 'Get an item from a config store',
  'type' => 'read',
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

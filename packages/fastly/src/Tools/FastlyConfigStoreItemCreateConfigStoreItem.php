<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create an entry in a config store
 *
 * Maps to Fastly generated client operation ConfigStoreItemApi::createConfigStoreItem (POST /resources/stores/config/{config_store_id}/item).
 */
class FastlyConfigStoreItemCreateConfigStoreItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_item_create_config_store_item';
    protected const DESCRIPTION = 'Create an entry in a config store

Official Fastly client operation: ConfigStoreItemApi::createConfigStoreItem
Endpoint: POST /resources/stores/config/{config_store_id}/item

Create an entry in a config store';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
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
  'slug' => 'fastly_config_store_item_create_config_store_item',
  'class' => 'FastlyConfigStoreItemCreateConfigStoreItem',
  'api_class' => 'ConfigStoreItemApi',
  'method_name' => 'createConfigStoreItem',
  'method' => 'POST',
  'path' => '/resources/stores/config/{config_store_id}/item',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create an entry in a config store',
  'description' => 'Create an entry in a config store',
  'type' => 'write',
  'parameters' =>
  array (
    'config_store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `config_store_id`.',
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

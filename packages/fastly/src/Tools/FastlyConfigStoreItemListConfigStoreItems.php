<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List items in a config store
 *
 * Maps to Fastly generated client operation ConfigStoreItemApi::listConfigStoreItems (GET /resources/stores/config/{config_store_id}/items).
 */
class FastlyConfigStoreItemListConfigStoreItems extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_item_list_config_store_items';
    protected const DESCRIPTION = 'List items in a config store

Official Fastly client operation: ConfigStoreItemApi::listConfigStoreItems
Endpoint: GET /resources/stores/config/{config_store_id}/items

List items in a config store';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_item_list_config_store_items',
  'class' => 'FastlyConfigStoreItemListConfigStoreItems',
  'api_class' => 'ConfigStoreItemApi',
  'method_name' => 'listConfigStoreItems',
  'method' => 'GET',
  'path' => '/resources/stores/config/{config_store_id}/items',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List items in a config store',
  'description' => 'List items in a config store',
  'type' => 'read',
  'parameters' =>
  array (
    'config_store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `config_store_id`.',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update multiple entries in a config store
 *
 * Maps to Fastly generated client operation ConfigStoreItemApi::bulkUpdateConfigStoreItem (PATCH /resources/stores/config/{config_store_id}/items).
 */
class FastlyConfigStoreItemBulkUpdateConfigStoreItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_item_bulk_update_config_store_item';
    protected const DESCRIPTION = 'Update multiple entries in a config store

Official Fastly client operation: ConfigStoreItemApi::bulkUpdateConfigStoreItem
Endpoint: PATCH /resources/stores/config/{config_store_id}/items

Update multiple entries in a config store';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
  ),
  'bulk_update_config_store_list_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `bulk_update_config_store_list_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_item_bulk_update_config_store_item',
  'class' => 'FastlyConfigStoreItemBulkUpdateConfigStoreItem',
  'api_class' => 'ConfigStoreItemApi',
  'method_name' => 'bulkUpdateConfigStoreItem',
  'method' => 'PATCH',
  'path' => '/resources/stores/config/{config_store_id}/items',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update multiple entries in a config store',
  'description' => 'Update multiple entries in a config store',
  'type' => 'write',
  'parameters' =>
  array (
    'config_store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `config_store_id`.',
    ),
    'bulk_update_config_store_list_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `bulk_update_config_store_list_request`.',
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
  'body_param' => 'bulk_update_config_store_list_request',
  'body_required' => false,
);
}

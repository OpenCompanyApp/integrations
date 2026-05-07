<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update multiple entries in a dictionary
 *
 * Maps to Fastly generated client operation DictionaryItemApi::bulkUpdateDictionaryItem (PATCH /service/{service_id}/dictionary/{dictionary_id}/items).
 */
class FastlyDictionaryItemBulkUpdateDictionaryItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_item_bulk_update_dictionary_item';
    protected const DESCRIPTION = 'Update multiple entries in a dictionary

Official Fastly client operation: DictionaryItemApi::bulkUpdateDictionaryItem
Endpoint: PATCH /service/{service_id}/dictionary/{dictionary_id}/items

Update multiple entries in a dictionary';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'dictionary_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `dictionary_id`.',
  ),
  'bulk_update_dictionary_list_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `bulk_update_dictionary_list_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dictionary_item_bulk_update_dictionary_item',
  'class' => 'FastlyDictionaryItemBulkUpdateDictionaryItem',
  'api_class' => 'DictionaryItemApi',
  'method_name' => 'bulkUpdateDictionaryItem',
  'method' => 'PATCH',
  'path' => '/service/{service_id}/dictionary/{dictionary_id}/items',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update multiple entries in a dictionary',
  'description' => 'Update multiple entries in a dictionary',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'dictionary_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `dictionary_id`.',
    ),
    'bulk_update_dictionary_list_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `bulk_update_dictionary_list_request`.',
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
    'service_id' => 'service_id',
    'dictionary_id' => 'dictionary_id',
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
  'body_param' => 'bulk_update_dictionary_list_request',
  'body_required' => false,
);
}

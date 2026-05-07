<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an item from a dictionary
 *
 * Maps to Fastly generated client operation DictionaryItemApi::deleteDictionaryItem (DELETE /service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}).
 */
class FastlyDictionaryItemDeleteDictionaryItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_item_delete_dictionary_item';
    protected const DESCRIPTION = 'Delete an item from a dictionary

Official Fastly client operation: DictionaryItemApi::deleteDictionaryItem
Endpoint: DELETE /service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}

Delete an item from a dictionary';
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
  'dictionary_item_key' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `dictionary_item_key`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dictionary_item_delete_dictionary_item',
  'class' => 'FastlyDictionaryItemDeleteDictionaryItem',
  'api_class' => 'DictionaryItemApi',
  'method_name' => 'deleteDictionaryItem',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an item from a dictionary',
  'description' => 'Delete an item from a dictionary',
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
    'dictionary_item_key' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `dictionary_item_key`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'dictionary_id' => 'dictionary_id',
    'dictionary_item_key' => 'dictionary_item_key',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an entry in a dictionary
 *
 * Maps to Fastly generated client operation DictionaryItemApi::updateDictionaryItem (PATCH /service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}).
 */
class FastlyDictionaryItemUpdateDictionaryItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_item_update_dictionary_item';
    protected const DESCRIPTION = 'Update an entry in a dictionary

Official Fastly client operation: DictionaryItemApi::updateDictionaryItem
Endpoint: PATCH /service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}

Update an entry in a dictionary';
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
  'slug' => 'fastly_dictionary_item_update_dictionary_item',
  'class' => 'FastlyDictionaryItemUpdateDictionaryItem',
  'api_class' => 'DictionaryItemApi',
  'method_name' => 'updateDictionaryItem',
  'method' => 'PATCH',
  'path' => '/service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an entry in a dictionary',
  'description' => 'Update an entry in a dictionary',
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
    'item_key' => 'item_key',
    'item_value' => 'item_value',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

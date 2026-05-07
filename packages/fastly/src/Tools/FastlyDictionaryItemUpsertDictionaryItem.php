<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Insert or update an entry in a dictionary
 *
 * Maps to Fastly generated client operation DictionaryItemApi::upsertDictionaryItem (PUT /service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}).
 */
class FastlyDictionaryItemUpsertDictionaryItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_item_upsert_dictionary_item';
    protected const DESCRIPTION = 'Insert or update an entry in a dictionary

Official Fastly client operation: DictionaryItemApi::upsertDictionaryItem
Endpoint: PUT /service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}

Insert or update an entry in a dictionary';
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
  'slug' => 'fastly_dictionary_item_upsert_dictionary_item',
  'class' => 'FastlyDictionaryItemUpsertDictionaryItem',
  'api_class' => 'DictionaryItemApi',
  'method_name' => 'upsertDictionaryItem',
  'method' => 'PUT',
  'path' => '/service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Insert or update an entry in a dictionary',
  'description' => 'Insert or update an entry in a dictionary',
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

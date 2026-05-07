<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create an entry in a dictionary
 *
 * Maps to Fastly generated client operation DictionaryItemApi::createDictionaryItem (POST /service/{service_id}/dictionary/{dictionary_id}/item).
 */
class FastlyDictionaryItemCreateDictionaryItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_item_create_dictionary_item';
    protected const DESCRIPTION = 'Create an entry in a dictionary

Official Fastly client operation: DictionaryItemApi::createDictionaryItem
Endpoint: POST /service/{service_id}/dictionary/{dictionary_id}/item

Create an entry in a dictionary';
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
  'slug' => 'fastly_dictionary_item_create_dictionary_item',
  'class' => 'FastlyDictionaryItemCreateDictionaryItem',
  'api_class' => 'DictionaryItemApi',
  'method_name' => 'createDictionaryItem',
  'method' => 'POST',
  'path' => '/service/{service_id}/dictionary/{dictionary_id}/item',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create an entry in a dictionary',
  'description' => 'Create an entry in a dictionary',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an item from a dictionary
 *
 * Maps to Fastly generated client operation DictionaryItemApi::getDictionaryItem (GET /service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}).
 */
class FastlyDictionaryItemGetDictionaryItem extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_item_get_dictionary_item';
    protected const DESCRIPTION = 'Get an item from a dictionary

Official Fastly client operation: DictionaryItemApi::getDictionaryItem
Endpoint: GET /service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}

Get an item from a dictionary';
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
  'slug' => 'fastly_dictionary_item_get_dictionary_item',
  'class' => 'FastlyDictionaryItemGetDictionaryItem',
  'api_class' => 'DictionaryItemApi',
  'method_name' => 'getDictionaryItem',
  'method' => 'GET',
  'path' => '/service/{service_id}/dictionary/{dictionary_id}/item/{dictionary_item_key}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an item from a dictionary',
  'description' => 'Get an item from a dictionary',
  'type' => 'read',
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

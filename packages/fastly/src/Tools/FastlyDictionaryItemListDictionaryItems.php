<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List items in a dictionary
 *
 * Maps to Fastly generated client operation DictionaryItemApi::listDictionaryItems (GET /service/{service_id}/dictionary/{dictionary_id}/items).
 */
class FastlyDictionaryItemListDictionaryItems extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_item_list_dictionary_items';
    protected const DESCRIPTION = 'List items in a dictionary

Official Fastly client operation: DictionaryItemApi::listDictionaryItems
Endpoint: GET /service/{service_id}/dictionary/{dictionary_id}/items

List items in a dictionary';
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
  'page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page`.',
  ),
  'per_page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `per_page`.',
  ),
  'sort' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `sort`.',
  ),
  'direction' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `direction`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dictionary_item_list_dictionary_items',
  'class' => 'FastlyDictionaryItemListDictionaryItems',
  'api_class' => 'DictionaryItemApi',
  'method_name' => 'listDictionaryItems',
  'method' => 'GET',
  'path' => '/service/{service_id}/dictionary/{dictionary_id}/items',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List items in a dictionary',
  'description' => 'List items in a dictionary',
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
    'page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page`.',
    ),
    'per_page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `per_page`.',
    ),
    'sort' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `sort`.',
    ),
    'direction' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `direction`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'dictionary_id' => 'dictionary_id',
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'per_page' => 'per_page',
    'sort' => 'sort',
    'direction' => 'direction',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a dictionary
 *
 * Maps to Fastly generated client operation DictionaryApi::getDictionary (GET /service/{service_id}/version/{version_id}/dictionary/{dictionary_name}).
 */
class FastlyDictionaryGetDictionary extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_get_dictionary';
    protected const DESCRIPTION = 'Get a dictionary

Official Fastly client operation: DictionaryApi::getDictionary
Endpoint: GET /service/{service_id}/version/{version_id}/dictionary/{dictionary_name}

Get a dictionary';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `version_id`.',
  ),
  'dictionary_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `dictionary_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dictionary_get_dictionary',
  'class' => 'FastlyDictionaryGetDictionary',
  'api_class' => 'DictionaryApi',
  'method_name' => 'getDictionary',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/dictionary/{dictionary_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a dictionary',
  'description' => 'Get a dictionary',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `version_id`.',
    ),
    'dictionary_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `dictionary_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'dictionary_name' => 'dictionary_name',
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

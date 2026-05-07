<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a dictionary
 *
 * Maps to Fastly generated client operation DictionaryApi::updateDictionary (PUT /service/{service_id}/version/{version_id}/dictionary/{dictionary_name}).
 */
class FastlyDictionaryUpdateDictionary extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_update_dictionary';
    protected const DESCRIPTION = 'Update a dictionary

Official Fastly client operation: DictionaryApi::updateDictionary
Endpoint: PUT /service/{service_id}/version/{version_id}/dictionary/{dictionary_name}

Update a dictionary';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'write_only' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `write_only`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dictionary_update_dictionary',
  'class' => 'FastlyDictionaryUpdateDictionary',
  'api_class' => 'DictionaryApi',
  'method_name' => 'updateDictionary',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/dictionary/{dictionary_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a dictionary',
  'description' => 'Update a dictionary',
  'type' => 'write',
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
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'write_only' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `write_only`.',
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
    'name' => 'name',
    'write_only' => 'write_only',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

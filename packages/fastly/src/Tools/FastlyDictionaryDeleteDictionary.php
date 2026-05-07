<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a dictionary
 *
 * Maps to Fastly generated client operation DictionaryApi::deleteDictionary (DELETE /service/{service_id}/version/{version_id}/dictionary/{dictionary_name}).
 */
class FastlyDictionaryDeleteDictionary extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_delete_dictionary';
    protected const DESCRIPTION = 'Delete a dictionary

Official Fastly client operation: DictionaryApi::deleteDictionary
Endpoint: DELETE /service/{service_id}/version/{version_id}/dictionary/{dictionary_name}

Delete a dictionary';
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
  'slug' => 'fastly_dictionary_delete_dictionary',
  'class' => 'FastlyDictionaryDeleteDictionary',
  'api_class' => 'DictionaryApi',
  'method_name' => 'deleteDictionary',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/dictionary/{dictionary_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a dictionary',
  'description' => 'Delete a dictionary',
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

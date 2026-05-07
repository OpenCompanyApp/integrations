<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a dictionary
 *
 * Maps to Fastly generated client operation DictionaryApi::createDictionary (POST /service/{service_id}/version/{version_id}/dictionary).
 */
class FastlyDictionaryCreateDictionary extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_create_dictionary';
    protected const DESCRIPTION = 'Create a dictionary

Official Fastly client operation: DictionaryApi::createDictionary
Endpoint: POST /service/{service_id}/version/{version_id}/dictionary

Create a dictionary';
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
  'slug' => 'fastly_dictionary_create_dictionary',
  'class' => 'FastlyDictionaryCreateDictionary',
  'api_class' => 'DictionaryApi',
  'method_name' => 'createDictionary',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/dictionary',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a dictionary',
  'description' => 'Create a dictionary',
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

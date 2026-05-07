<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List dictionaries
 *
 * Maps to Fastly generated client operation DictionaryApi::listDictionaries (GET /service/{service_id}/version/{version_id}/dictionary).
 */
class FastlyDictionaryListDictionaries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_list_dictionaries';
    protected const DESCRIPTION = 'List dictionaries

Official Fastly client operation: DictionaryApi::listDictionaries
Endpoint: GET /service/{service_id}/version/{version_id}/dictionary

List dictionaries';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_dictionary_list_dictionaries',
  'class' => 'FastlyDictionaryListDictionaries',
  'api_class' => 'DictionaryApi',
  'method_name' => 'listDictionaries',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/dictionary',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List dictionaries',
  'description' => 'List dictionaries',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

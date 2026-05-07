<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get dictionary metadata
 *
 * Maps to Fastly generated client operation DictionaryInfoApi::getDictionaryInfo (GET /service/{service_id}/version/{version_id}/dictionary/{dictionary_id}/info).
 */
class FastlyDictionaryInfoGetDictionaryInfo extends AbstractFastlyTool
{
    protected const NAME = 'fastly_dictionary_info_get_dictionary_info';
    protected const DESCRIPTION = 'Get dictionary metadata

Official Fastly client operation: DictionaryInfoApi::getDictionaryInfo
Endpoint: GET /service/{service_id}/version/{version_id}/dictionary/{dictionary_id}/info

Get dictionary metadata';
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
  'dictionary_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `dictionary_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_dictionary_info_get_dictionary_info',
  'class' => 'FastlyDictionaryInfoGetDictionaryInfo',
  'api_class' => 'DictionaryInfoApi',
  'method_name' => 'getDictionaryInfo',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/dictionary/{dictionary_id}/info',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get dictionary metadata',
  'description' => 'Get dictionary metadata',
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
    'dictionary_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `dictionary_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

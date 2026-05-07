<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List config stores
 *
 * Maps to Fastly generated client operation ConfigStoreApi::listConfigStores (GET /resources/stores/config).
 */
class FastlyConfigStoreListConfigStores extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_list_config_stores';
    protected const DESCRIPTION = 'List config stores

Official Fastly client operation: ConfigStoreApi::listConfigStores
Endpoint: GET /resources/stores/config

List config stores';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_list_config_stores',
  'class' => 'FastlyConfigStoreListConfigStores',
  'api_class' => 'ConfigStoreApi',
  'method_name' => 'listConfigStores',
  'method' => 'GET',
  'path' => '/resources/stores/config',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List config stores',
  'description' => 'List config stores',
  'type' => 'read',
  'parameters' =>
  array (
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'name' => 'name',
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

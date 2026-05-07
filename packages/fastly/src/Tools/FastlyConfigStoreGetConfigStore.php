<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Describe a config store
 *
 * Maps to Fastly generated client operation ConfigStoreApi::getConfigStore (GET /resources/stores/config/{config_store_id}).
 */
class FastlyConfigStoreGetConfigStore extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_get_config_store';
    protected const DESCRIPTION = 'Describe a config store

Official Fastly client operation: ConfigStoreApi::getConfigStore
Endpoint: GET /resources/stores/config/{config_store_id}

Describe a config store';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_get_config_store',
  'class' => 'FastlyConfigStoreGetConfigStore',
  'api_class' => 'ConfigStoreApi',
  'method_name' => 'getConfigStore',
  'method' => 'GET',
  'path' => '/resources/stores/config/{config_store_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Describe a config store',
  'description' => 'Describe a config store',
  'type' => 'read',
  'parameters' =>
  array (
    'config_store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `config_store_id`.',
    ),
  ),
  'path_params' =>
  array (
    'config_store_id' => 'config_store_id',
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

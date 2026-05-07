<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a config store
 *
 * Maps to Fastly generated client operation ConfigStoreApi::updateConfigStore (PUT /resources/stores/config/{config_store_id}).
 */
class FastlyConfigStoreUpdateConfigStore extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_update_config_store';
    protected const DESCRIPTION = 'Update a config store

Official Fastly client operation: ConfigStoreApi::updateConfigStore
Endpoint: PUT /resources/stores/config/{config_store_id}

Update a config store';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_update_config_store',
  'class' => 'FastlyConfigStoreUpdateConfigStore',
  'api_class' => 'ConfigStoreApi',
  'method_name' => 'updateConfigStore',
  'method' => 'PUT',
  'path' => '/resources/stores/config/{config_store_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a config store',
  'description' => 'Update a config store',
  'type' => 'write',
  'parameters' =>
  array (
    'config_store_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `config_store_id`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
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
    'name' => 'name',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

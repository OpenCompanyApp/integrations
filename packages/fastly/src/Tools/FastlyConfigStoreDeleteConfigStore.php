<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a config store
 *
 * Maps to Fastly generated client operation ConfigStoreApi::deleteConfigStore (DELETE /resources/stores/config/{config_store_id}).
 */
class FastlyConfigStoreDeleteConfigStore extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_delete_config_store';
    protected const DESCRIPTION = 'Delete a config store

Official Fastly client operation: ConfigStoreApi::deleteConfigStore
Endpoint: DELETE /resources/stores/config/{config_store_id}

Delete a config store';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_delete_config_store',
  'class' => 'FastlyConfigStoreDeleteConfigStore',
  'api_class' => 'ConfigStoreApi',
  'method_name' => 'deleteConfigStore',
  'method' => 'DELETE',
  'path' => '/resources/stores/config/{config_store_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a config store',
  'description' => 'Delete a config store',
  'type' => 'write',
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

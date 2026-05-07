<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a config store
 *
 * Maps to Fastly generated client operation ConfigStoreApi::createConfigStore (POST /resources/stores/config).
 */
class FastlyConfigStoreCreateConfigStore extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_create_config_store';
    protected const DESCRIPTION = 'Create a config store

Official Fastly client operation: ConfigStoreApi::createConfigStore
Endpoint: POST /resources/stores/config

Create a config store';
    protected const PARAMETERS = array (
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_create_config_store',
  'class' => 'FastlyConfigStoreCreateConfigStore',
  'api_class' => 'ConfigStoreApi',
  'method_name' => 'createConfigStore',
  'method' => 'POST',
  'path' => '/resources/stores/config',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a config store',
  'description' => 'Create a config store',
  'type' => 'write',
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

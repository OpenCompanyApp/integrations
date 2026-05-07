<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get config store metadata
 *
 * Maps to Fastly generated client operation ConfigStoreApi::getConfigStoreInfo (GET /resources/stores/config/{config_store_id}/info).
 */
class FastlyConfigStoreGetConfigStoreInfo extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_get_config_store_info';
    protected const DESCRIPTION = 'Get config store metadata

Official Fastly client operation: ConfigStoreApi::getConfigStoreInfo
Endpoint: GET /resources/stores/config/{config_store_id}/info

Get config store metadata';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_get_config_store_info',
  'class' => 'FastlyConfigStoreGetConfigStoreInfo',
  'api_class' => 'ConfigStoreApi',
  'method_name' => 'getConfigStoreInfo',
  'method' => 'GET',
  'path' => '/resources/stores/config/{config_store_id}/info',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get config store metadata',
  'description' => 'Get config store metadata',
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

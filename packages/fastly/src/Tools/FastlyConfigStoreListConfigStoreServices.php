<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List linked services
 *
 * Maps to Fastly generated client operation ConfigStoreApi::listConfigStoreServices (GET /resources/stores/config/{config_store_id}/services).
 */
class FastlyConfigStoreListConfigStoreServices extends AbstractFastlyTool
{
    protected const NAME = 'fastly_config_store_list_config_store_services';
    protected const DESCRIPTION = 'List linked services

Official Fastly client operation: ConfigStoreApi::listConfigStoreServices
Endpoint: GET /resources/stores/config/{config_store_id}/services

List linked services';
    protected const PARAMETERS = array (
  'config_store_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `config_store_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_config_store_list_config_store_services',
  'class' => 'FastlyConfigStoreListConfigStoreServices',
  'api_class' => 'ConfigStoreApi',
  'method_name' => 'listConfigStoreServices',
  'method' => 'GET',
  'path' => '/resources/stores/config/{config_store_id}/services',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List linked services',
  'description' => 'List linked services',
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

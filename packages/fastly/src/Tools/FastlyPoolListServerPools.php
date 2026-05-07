<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List server pools
 *
 * Maps to Fastly generated client operation PoolApi::listServerPools (GET /service/{service_id}/version/{version_id}/pool).
 */
class FastlyPoolListServerPools extends AbstractFastlyTool
{
    protected const NAME = 'fastly_pool_list_server_pools';
    protected const DESCRIPTION = 'List server pools

Official Fastly client operation: PoolApi::listServerPools
Endpoint: GET /service/{service_id}/version/{version_id}/pool

List server pools';
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
  'slug' => 'fastly_pool_list_server_pools',
  'class' => 'FastlyPoolListServerPools',
  'api_class' => 'PoolApi',
  'method_name' => 'listServerPools',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/pool',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List server pools',
  'description' => 'List server pools',
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

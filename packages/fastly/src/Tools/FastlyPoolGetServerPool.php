<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a server pool
 *
 * Maps to Fastly generated client operation PoolApi::getServerPool (GET /service/{service_id}/version/{version_id}/pool/{pool_name}).
 */
class FastlyPoolGetServerPool extends AbstractFastlyTool
{
    protected const NAME = 'fastly_pool_get_server_pool';
    protected const DESCRIPTION = 'Get a server pool

Official Fastly client operation: PoolApi::getServerPool
Endpoint: GET /service/{service_id}/version/{version_id}/pool/{pool_name}

Get a server pool';
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
  'pool_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `pool_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_pool_get_server_pool',
  'class' => 'FastlyPoolGetServerPool',
  'api_class' => 'PoolApi',
  'method_name' => 'getServerPool',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/pool/{pool_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a server pool',
  'description' => 'Get a server pool',
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
    'pool_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `pool_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'pool_name' => 'pool_name',
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

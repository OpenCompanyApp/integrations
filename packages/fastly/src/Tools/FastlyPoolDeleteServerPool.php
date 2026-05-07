<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a server pool
 *
 * Maps to Fastly generated client operation PoolApi::deleteServerPool (DELETE /service/{service_id}/version/{version_id}/pool/{pool_name}).
 */
class FastlyPoolDeleteServerPool extends AbstractFastlyTool
{
    protected const NAME = 'fastly_pool_delete_server_pool';
    protected const DESCRIPTION = 'Delete a server pool

Official Fastly client operation: PoolApi::deleteServerPool
Endpoint: DELETE /service/{service_id}/version/{version_id}/pool/{pool_name}

Delete a server pool';
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
  'slug' => 'fastly_pool_delete_server_pool',
  'class' => 'FastlyPoolDeleteServerPool',
  'api_class' => 'PoolApi',
  'method_name' => 'deleteServerPool',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/pool/{pool_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a server pool',
  'description' => 'Delete a server pool',
  'type' => 'write',
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

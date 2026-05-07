<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a server from a pool
 *
 * Maps to Fastly generated client operation ServerApi::deletePoolServer (DELETE /service/{service_id}/pool/{pool_id}/server/{server_id}).
 */
class FastlyServerDeletePoolServer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_server_delete_pool_server';
    protected const DESCRIPTION = 'Delete a server from a pool

Official Fastly client operation: ServerApi::deletePoolServer
Endpoint: DELETE /service/{service_id}/pool/{pool_id}/server/{server_id}

Delete a server from a pool';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'pool_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `pool_id`.',
  ),
  'server_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `server_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_server_delete_pool_server',
  'class' => 'FastlyServerDeletePoolServer',
  'api_class' => 'ServerApi',
  'method_name' => 'deletePoolServer',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/pool/{pool_id}/server/{server_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a server from a pool',
  'description' => 'Delete a server from a pool',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'pool_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `pool_id`.',
    ),
    'server_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `server_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'pool_id' => 'pool_id',
    'server_id' => 'server_id',
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

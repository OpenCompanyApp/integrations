<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a pool server
 *
 * Maps to Fastly generated client operation ServerApi::getPoolServer (GET /service/{service_id}/pool/{pool_id}/server/{server_id}).
 */
class FastlyServerGetPoolServer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_server_get_pool_server';
    protected const DESCRIPTION = 'Get a pool server

Official Fastly client operation: ServerApi::getPoolServer
Endpoint: GET /service/{service_id}/pool/{pool_id}/server/{server_id}

Get a pool server';
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
  'slug' => 'fastly_server_get_pool_server',
  'class' => 'FastlyServerGetPoolServer',
  'api_class' => 'ServerApi',
  'method_name' => 'getPoolServer',
  'method' => 'GET',
  'path' => '/service/{service_id}/pool/{pool_id}/server/{server_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a pool server',
  'description' => 'Get a pool server',
  'type' => 'read',
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

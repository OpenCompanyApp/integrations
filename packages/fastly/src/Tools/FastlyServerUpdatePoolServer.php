<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a server
 *
 * Maps to Fastly generated client operation ServerApi::updatePoolServer (PUT /service/{service_id}/pool/{pool_id}/server/{server_id}).
 */
class FastlyServerUpdatePoolServer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_server_update_pool_server';
    protected const DESCRIPTION = 'Update a server

Official Fastly client operation: ServerApi::updatePoolServer
Endpoint: PUT /service/{service_id}/pool/{pool_id}/server/{server_id}

Update a server';
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
  'weight' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `weight`.',
  ),
  'max_conn' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `max_conn`.',
  ),
  'port' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `port`.',
  ),
  'address' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `address`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'disabled' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `disabled`.',
  ),
  'override_host' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `override_host`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_server_update_pool_server',
  'class' => 'FastlyServerUpdatePoolServer',
  'api_class' => 'ServerApi',
  'method_name' => 'updatePoolServer',
  'method' => 'PUT',
  'path' => '/service/{service_id}/pool/{pool_id}/server/{server_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a server',
  'description' => 'Update a server',
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
    'weight' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `weight`.',
    ),
    'max_conn' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `max_conn`.',
    ),
    'port' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `port`.',
    ),
    'address' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `address`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'disabled' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `disabled`.',
    ),
    'override_host' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `override_host`.',
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
    'weight' => 'weight',
    'max_conn' => 'max_conn',
    'port' => 'port',
    'address' => 'address',
    'comment' => 'comment',
    'disabled' => 'disabled',
    'override_host' => 'override_host',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

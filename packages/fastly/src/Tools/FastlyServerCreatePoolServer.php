<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Add a server to a pool
 *
 * Maps to Fastly generated client operation ServerApi::createPoolServer (POST /service/{service_id}/pool/{pool_id}/server).
 */
class FastlyServerCreatePoolServer extends AbstractFastlyTool
{
    protected const NAME = 'fastly_server_create_pool_server';
    protected const DESCRIPTION = 'Add a server to a pool

Official Fastly client operation: ServerApi::createPoolServer
Endpoint: POST /service/{service_id}/pool/{pool_id}/server

Add a server to a pool';
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
  'slug' => 'fastly_server_create_pool_server',
  'class' => 'FastlyServerCreatePoolServer',
  'api_class' => 'ServerApi',
  'method_name' => 'createPoolServer',
  'method' => 'POST',
  'path' => '/service/{service_id}/pool/{pool_id}/server',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Add a server to a pool',
  'description' => 'Add a server to a pool',
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

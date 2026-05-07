<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List servers in a pool
 *
 * Maps to Fastly generated client operation ServerApi::listPoolServers (GET /service/{service_id}/pool/{pool_id}/servers).
 */
class FastlyServerListPoolServers extends AbstractFastlyTool
{
    protected const NAME = 'fastly_server_list_pool_servers';
    protected const DESCRIPTION = 'List servers in a pool

Official Fastly client operation: ServerApi::listPoolServers
Endpoint: GET /service/{service_id}/pool/{pool_id}/servers

List servers in a pool';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_server_list_pool_servers',
  'class' => 'FastlyServerListPoolServers',
  'api_class' => 'ServerApi',
  'method_name' => 'listPoolServers',
  'method' => 'GET',
  'path' => '/service/{service_id}/pool/{pool_id}/servers',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List servers in a pool',
  'description' => 'List servers in a pool',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

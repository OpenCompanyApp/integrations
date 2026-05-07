<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a service
 *
 * Maps to Fastly generated client operation ServiceApi::getService (GET /service/{service_id}).
 */
class FastlyServiceGetService extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_get_service';
    protected const DESCRIPTION = 'Get a service

Official Fastly client operation: ServiceApi::getService
Endpoint: GET /service/{service_id}

Get a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_get_service',
  'class' => 'FastlyServiceGetService',
  'api_class' => 'ServiceApi',
  'method_name' => 'getService',
  'method' => 'GET',
  'path' => '/service/{service_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a service',
  'description' => 'Get a service',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
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

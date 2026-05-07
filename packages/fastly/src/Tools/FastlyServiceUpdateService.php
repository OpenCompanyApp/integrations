<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a service
 *
 * Maps to Fastly generated client operation ServiceApi::updateService (PUT /service/{service_id}).
 */
class FastlyServiceUpdateService extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_update_service';
    protected const DESCRIPTION = 'Update a service

Official Fastly client operation: ServiceApi::updateService
Endpoint: PUT /service/{service_id}

Update a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'customer_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `customer_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_update_service',
  'class' => 'FastlyServiceUpdateService',
  'api_class' => 'ServiceApi',
  'method_name' => 'updateService',
  'method' => 'PUT',
  'path' => '/service/{service_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a service',
  'description' => 'Update a service',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'customer_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `customer_id`.',
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
    'comment' => 'comment',
    'name' => 'name',
    'customer_id' => 'customer_id',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a service
 *
 * Maps to Fastly generated client operation ServiceApi::createService (POST /service).
 */
class FastlyServiceCreateService extends AbstractFastlyTool
{
    protected const NAME = 'fastly_service_create_service';
    protected const DESCRIPTION = 'Create a service

Official Fastly client operation: ServiceApi::createService
Endpoint: POST /service

Create a service';
    protected const PARAMETERS = array (
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
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `type`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_service_create_service',
  'class' => 'FastlyServiceCreateService',
  'api_class' => 'ServiceApi',
  'method_name' => 'createService',
  'method' => 'POST',
  'path' => '/service',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a service',
  'description' => 'Create a service',
  'type' => 'write',
  'parameters' =>
  array (
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
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `type`.',
    ),
  ),
  'path_params' =>
  array (
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
    'type' => 'type',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

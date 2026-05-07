<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Response object
 *
 * Maps to Fastly generated client operation ResponseObjectApi::getResponseObject (GET /service/{service_id}/version/{version_id}/response_object/{response_object_name}).
 */
class FastlyResponseObjectGetResponseObject extends AbstractFastlyTool
{
    protected const NAME = 'fastly_response_object_get_response_object';
    protected const DESCRIPTION = 'Get a Response object

Official Fastly client operation: ResponseObjectApi::getResponseObject
Endpoint: GET /service/{service_id}/version/{version_id}/response_object/{response_object_name}

Get a Response object';
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
  'response_object_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `response_object_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_response_object_get_response_object',
  'class' => 'FastlyResponseObjectGetResponseObject',
  'api_class' => 'ResponseObjectApi',
  'method_name' => 'getResponseObject',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/response_object/{response_object_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Response object',
  'description' => 'Get a Response object',
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
    'response_object_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `response_object_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'response_object_name' => 'response_object_name',
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

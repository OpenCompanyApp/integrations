<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a Response object
 *
 * Maps to Fastly generated client operation ResponseObjectApi::createResponseObject (POST /service/{service_id}/version/{version_id}/response_object).
 */
class FastlyResponseObjectCreateResponseObject extends AbstractFastlyTool
{
    protected const NAME = 'fastly_response_object_create_response_object';
    protected const DESCRIPTION = 'Create a Response object

Official Fastly client operation: ResponseObjectApi::createResponseObject
Endpoint: POST /service/{service_id}/version/{version_id}/response_object

Create a Response object';
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
  'create_response_object_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `create_response_object_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_response_object_create_response_object',
  'class' => 'FastlyResponseObjectCreateResponseObject',
  'api_class' => 'ResponseObjectApi',
  'method_name' => 'createResponseObject',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/response_object',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a Response object',
  'description' => 'Create a Response object',
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
    'create_response_object_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `create_response_object_request`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
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
  'body_param' => 'create_response_object_request',
  'body_required' => false,
);
}

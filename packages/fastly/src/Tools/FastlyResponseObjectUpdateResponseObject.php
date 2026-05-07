<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a Response object
 *
 * Maps to Fastly generated client operation ResponseObjectApi::updateResponseObject (PUT /service/{service_id}/version/{version_id}/response_object/{response_object_name}).
 */
class FastlyResponseObjectUpdateResponseObject extends AbstractFastlyTool
{
    protected const NAME = 'fastly_response_object_update_response_object';
    protected const DESCRIPTION = 'Update a Response object

Official Fastly client operation: ResponseObjectApi::updateResponseObject
Endpoint: PUT /service/{service_id}/version/{version_id}/response_object/{response_object_name}

Update a Response object';
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
  'slug' => 'fastly_response_object_update_response_object',
  'class' => 'FastlyResponseObjectUpdateResponseObject',
  'api_class' => 'ResponseObjectApi',
  'method_name' => 'updateResponseObject',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/response_object/{response_object_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a Response object',
  'description' => 'Update a Response object',
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
    'response_object_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `response_object_name`.',
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
  'body_param' => 'create_response_object_request',
  'body_required' => false,
);
}

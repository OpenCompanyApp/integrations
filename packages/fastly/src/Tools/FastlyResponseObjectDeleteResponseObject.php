<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a Response Object
 *
 * Maps to Fastly generated client operation ResponseObjectApi::deleteResponseObject (DELETE /service/{service_id}/version/{version_id}/response_object/{response_object_name}).
 */
class FastlyResponseObjectDeleteResponseObject extends AbstractFastlyTool
{
    protected const NAME = 'fastly_response_object_delete_response_object';
    protected const DESCRIPTION = 'Delete a Response Object

Official Fastly client operation: ResponseObjectApi::deleteResponseObject
Endpoint: DELETE /service/{service_id}/version/{version_id}/response_object/{response_object_name}

Delete a Response Object';
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
  'slug' => 'fastly_response_object_delete_response_object',
  'class' => 'FastlyResponseObjectDeleteResponseObject',
  'api_class' => 'ResponseObjectApi',
  'method_name' => 'deleteResponseObject',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/response_object/{response_object_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a Response Object',
  'description' => 'Delete a Response Object',
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

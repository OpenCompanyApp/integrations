<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Response objects
 *
 * Maps to Fastly generated client operation ResponseObjectApi::listResponseObjects (GET /service/{service_id}/version/{version_id}/response_object).
 */
class FastlyResponseObjectListResponseObjects extends AbstractFastlyTool
{
    protected const NAME = 'fastly_response_object_list_response_objects';
    protected const DESCRIPTION = 'List Response objects

Official Fastly client operation: ResponseObjectApi::listResponseObjects
Endpoint: GET /service/{service_id}/version/{version_id}/response_object

List Response objects';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_response_object_list_response_objects',
  'class' => 'FastlyResponseObjectListResponseObjects',
  'api_class' => 'ResponseObjectApi',
  'method_name' => 'listResponseObjects',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/response_object',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Response objects',
  'description' => 'List Response objects',
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
  'body_param' => NULL,
  'body_required' => false,
);
}

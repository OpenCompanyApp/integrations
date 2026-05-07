<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Display a resource link
 *
 * Maps to Fastly generated client operation ResourceApi::getResource (GET /service/{service_id}/version/{version_id}/resource/{id}).
 */
class FastlyResourceGetResource extends AbstractFastlyTool
{
    protected const NAME = 'fastly_resource_get_resource';
    protected const DESCRIPTION = 'Display a resource link

Official Fastly client operation: ResourceApi::getResource
Endpoint: GET /service/{service_id}/version/{version_id}/resource/{id}

Display a resource link';
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
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_resource_get_resource',
  'class' => 'FastlyResourceGetResource',
  'api_class' => 'ResourceApi',
  'method_name' => 'getResource',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/resource/{id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Display a resource link',
  'description' => 'Display a resource link',
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
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `id`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'id' => 'id',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a resource link
 *
 * Maps to Fastly generated client operation ResourceApi::updateResource (PUT /service/{service_id}/version/{version_id}/resource/{id}).
 */
class FastlyResourceUpdateResource extends AbstractFastlyTool
{
    protected const NAME = 'fastly_resource_update_resource';
    protected const DESCRIPTION = 'Update a resource link

Official Fastly client operation: ResourceApi::updateResource
Endpoint: PUT /service/{service_id}/version/{version_id}/resource/{id}

Update a resource link';
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
  'resource_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `resource_id`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_resource_update_resource',
  'class' => 'FastlyResourceUpdateResource',
  'api_class' => 'ResourceApi',
  'method_name' => 'updateResource',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/resource/{id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a resource link',
  'description' => 'Update a resource link',
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
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `id`.',
    ),
    'resource_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `resource_id`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
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
    'resource_id' => 'resource_id',
    'name' => 'name',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

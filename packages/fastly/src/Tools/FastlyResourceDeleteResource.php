<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a resource link
 *
 * Maps to Fastly generated client operation ResourceApi::deleteResource (DELETE /service/{service_id}/version/{version_id}/resource/{id}).
 */
class FastlyResourceDeleteResource extends AbstractFastlyTool
{
    protected const NAME = 'fastly_resource_delete_resource';
    protected const DESCRIPTION = 'Delete a resource link

Official Fastly client operation: ResourceApi::deleteResource
Endpoint: DELETE /service/{service_id}/version/{version_id}/resource/{id}

Delete a resource link';
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
  'slug' => 'fastly_resource_delete_resource',
  'class' => 'FastlyResourceDeleteResource',
  'api_class' => 'ResourceApi',
  'method_name' => 'deleteResource',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/resource/{id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a resource link',
  'description' => 'Delete a resource link',
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

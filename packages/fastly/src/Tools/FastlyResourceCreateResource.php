<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a resource link
 *
 * Maps to Fastly generated client operation ResourceApi::createResource (POST /service/{service_id}/version/{version_id}/resource).
 */
class FastlyResourceCreateResource extends AbstractFastlyTool
{
    protected const NAME = 'fastly_resource_create_resource';
    protected const DESCRIPTION = 'Create a resource link

Official Fastly client operation: ResourceApi::createResource
Endpoint: POST /service/{service_id}/version/{version_id}/resource

Create a resource link';
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
  'slug' => 'fastly_resource_create_resource',
  'class' => 'FastlyResourceCreateResource',
  'api_class' => 'ResourceApi',
  'method_name' => 'createResource',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/resource',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a resource link',
  'description' => 'Create a resource link',
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

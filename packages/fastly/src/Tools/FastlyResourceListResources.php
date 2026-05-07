<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List resource links
 *
 * Maps to Fastly generated client operation ResourceApi::listResources (GET /service/{service_id}/version/{version_id}/resource).
 */
class FastlyResourceListResources extends AbstractFastlyTool
{
    protected const NAME = 'fastly_resource_list_resources';
    protected const DESCRIPTION = 'List resource links

Official Fastly client operation: ResourceApi::listResources
Endpoint: GET /service/{service_id}/version/{version_id}/resource

List resource links';
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
  'slug' => 'fastly_resource_list_resources',
  'class' => 'FastlyResourceListResources',
  'api_class' => 'ResourceApi',
  'method_name' => 'listResources',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/resource',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List resource links',
  'description' => 'List resource links',
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

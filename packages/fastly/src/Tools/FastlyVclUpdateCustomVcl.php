<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a custom VCL file
 *
 * Maps to Fastly generated client operation VclApi::updateCustomVcl (PUT /service/{service_id}/version/{version_id}/vcl/{vcl_name}).
 */
class FastlyVclUpdateCustomVcl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_update_custom_vcl';
    protected const DESCRIPTION = 'Update a custom VCL file

Official Fastly client operation: VclApi::updateCustomVcl
Endpoint: PUT /service/{service_id}/version/{version_id}/vcl/{vcl_name}

Update a custom VCL file';
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
  'vcl_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `vcl_name`.',
  ),
  'content' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `content`.',
  ),
  'main' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `main`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_vcl_update_custom_vcl',
  'class' => 'FastlyVclUpdateCustomVcl',
  'api_class' => 'VclApi',
  'method_name' => 'updateCustomVcl',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/vcl/{vcl_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a custom VCL file',
  'description' => 'Update a custom VCL file',
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
    'vcl_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `vcl_name`.',
    ),
    'content' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `content`.',
    ),
    'main' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `main`.',
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
    'vcl_name' => 'vcl_name',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
    'content' => 'content',
    'main' => 'main',
    'name' => 'name',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

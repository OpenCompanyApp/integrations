<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a custom VCL file
 *
 * Maps to Fastly generated client operation VclApi::createCustomVcl (POST /service/{service_id}/version/{version_id}/vcl).
 */
class FastlyVclCreateCustomVcl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_create_custom_vcl';
    protected const DESCRIPTION = 'Create a custom VCL file

Official Fastly client operation: VclApi::createCustomVcl
Endpoint: POST /service/{service_id}/version/{version_id}/vcl

Create a custom VCL file';
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
  'slug' => 'fastly_vcl_create_custom_vcl',
  'class' => 'FastlyVclCreateCustomVcl',
  'api_class' => 'VclApi',
  'method_name' => 'createCustomVcl',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/vcl',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a custom VCL file',
  'description' => 'Create a custom VCL file',
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

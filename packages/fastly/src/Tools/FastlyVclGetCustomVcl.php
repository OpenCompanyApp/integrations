<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a custom VCL file
 *
 * Maps to Fastly generated client operation VclApi::getCustomVcl (GET /service/{service_id}/version/{version_id}/vcl/{vcl_name}).
 */
class FastlyVclGetCustomVcl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_get_custom_vcl';
    protected const DESCRIPTION = 'Get a custom VCL file

Official Fastly client operation: VclApi::getCustomVcl
Endpoint: GET /service/{service_id}/version/{version_id}/vcl/{vcl_name}

Get a custom VCL file';
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
  'no_content' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `no_content`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_vcl_get_custom_vcl',
  'class' => 'FastlyVclGetCustomVcl',
  'api_class' => 'VclApi',
  'method_name' => 'getCustomVcl',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/vcl/{vcl_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a custom VCL file',
  'description' => 'Get a custom VCL file',
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
    'vcl_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `vcl_name`.',
    ),
    'no_content' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `no_content`.',
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
    'no_content' => 'no_content',
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

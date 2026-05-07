<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Download a custom VCL file
 *
 * Maps to Fastly generated client operation VclApi::getCustomVclRaw (GET /service/{service_id}/version/{version_id}/vcl/{vcl_name}/download).
 */
class FastlyVclGetCustomVclRaw extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_get_custom_vcl_raw';
    protected const DESCRIPTION = 'Download a custom VCL file

Official Fastly client operation: VclApi::getCustomVclRaw
Endpoint: GET /service/{service_id}/version/{version_id}/vcl/{vcl_name}/download

Download a custom VCL file';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_vcl_get_custom_vcl_raw',
  'class' => 'FastlyVclGetCustomVclRaw',
  'api_class' => 'VclApi',
  'method_name' => 'getCustomVclRaw',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/vcl/{vcl_name}/download',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Download a custom VCL file',
  'description' => 'Download a custom VCL file',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

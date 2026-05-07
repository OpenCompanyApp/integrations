<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a custom VCL file with syntax highlighting
 *
 * Maps to Fastly generated client operation VclApi::getCustomVclHighlighted (GET /service/{service_id}/version/{version_id}/vcl/{vcl_name}/content).
 */
class FastlyVclGetCustomVclHighlighted extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_get_custom_vcl_highlighted';
    protected const DESCRIPTION = 'Get a custom VCL file with syntax highlighting

Official Fastly client operation: VclApi::getCustomVclHighlighted
Endpoint: GET /service/{service_id}/version/{version_id}/vcl/{vcl_name}/content

Get a custom VCL file with syntax highlighting';
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
  'slug' => 'fastly_vcl_get_custom_vcl_highlighted',
  'class' => 'FastlyVclGetCustomVclHighlighted',
  'api_class' => 'VclApi',
  'method_name' => 'getCustomVclHighlighted',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/vcl/{vcl_name}/content',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a custom VCL file with syntax highlighting',
  'description' => 'Get a custom VCL file with syntax highlighting',
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

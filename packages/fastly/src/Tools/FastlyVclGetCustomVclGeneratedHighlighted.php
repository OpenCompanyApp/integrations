<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get the generated VCL with syntax highlighting
 *
 * Maps to Fastly generated client operation VclApi::getCustomVclGeneratedHighlighted (GET /service/{service_id}/version/{version_id}/generated_vcl/content).
 */
class FastlyVclGetCustomVclGeneratedHighlighted extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_get_custom_vcl_generated_highlighted';
    protected const DESCRIPTION = 'Get the generated VCL with syntax highlighting

Official Fastly client operation: VclApi::getCustomVclGeneratedHighlighted
Endpoint: GET /service/{service_id}/version/{version_id}/generated_vcl/content

Get the generated VCL with syntax highlighting';
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
  'slug' => 'fastly_vcl_get_custom_vcl_generated_highlighted',
  'class' => 'FastlyVclGetCustomVclGeneratedHighlighted',
  'api_class' => 'VclApi',
  'method_name' => 'getCustomVclGeneratedHighlighted',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/generated_vcl/content',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get the generated VCL with syntax highlighting',
  'description' => 'Get the generated VCL with syntax highlighting',
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

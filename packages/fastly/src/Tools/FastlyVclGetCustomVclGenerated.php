<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get the generated VCL for a service
 *
 * Maps to Fastly generated client operation VclApi::getCustomVclGenerated (GET /service/{service_id}/version/{version_id}/generated_vcl).
 */
class FastlyVclGetCustomVclGenerated extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_get_custom_vcl_generated';
    protected const DESCRIPTION = 'Get the generated VCL for a service

Official Fastly client operation: VclApi::getCustomVclGenerated
Endpoint: GET /service/{service_id}/version/{version_id}/generated_vcl

Get the generated VCL for a service';
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
  'slug' => 'fastly_vcl_get_custom_vcl_generated',
  'class' => 'FastlyVclGetCustomVclGenerated',
  'api_class' => 'VclApi',
  'method_name' => 'getCustomVclGenerated',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/generated_vcl',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get the generated VCL for a service',
  'description' => 'Get the generated VCL for a service',
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

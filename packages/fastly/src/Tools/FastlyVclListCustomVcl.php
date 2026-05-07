<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List custom VCL files
 *
 * Maps to Fastly generated client operation VclApi::listCustomVcl (GET /service/{service_id}/version/{version_id}/vcl).
 */
class FastlyVclListCustomVcl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_list_custom_vcl';
    protected const DESCRIPTION = 'List custom VCL files

Official Fastly client operation: VclApi::listCustomVcl
Endpoint: GET /service/{service_id}/version/{version_id}/vcl

List custom VCL files';
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
  'slug' => 'fastly_vcl_list_custom_vcl',
  'class' => 'FastlyVclListCustomVcl',
  'api_class' => 'VclApi',
  'method_name' => 'listCustomVcl',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/vcl',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List custom VCL files',
  'description' => 'List custom VCL files',
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

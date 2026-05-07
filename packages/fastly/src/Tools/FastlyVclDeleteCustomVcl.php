<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a custom VCL file
 *
 * Maps to Fastly generated client operation VclApi::deleteCustomVcl (DELETE /service/{service_id}/version/{version_id}/vcl/{vcl_name}).
 */
class FastlyVclDeleteCustomVcl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_delete_custom_vcl';
    protected const DESCRIPTION = 'Delete a custom VCL file

Official Fastly client operation: VclApi::deleteCustomVcl
Endpoint: DELETE /service/{service_id}/version/{version_id}/vcl/{vcl_name}

Delete a custom VCL file';
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
  'slug' => 'fastly_vcl_delete_custom_vcl',
  'class' => 'FastlyVclDeleteCustomVcl',
  'api_class' => 'VclApi',
  'method_name' => 'deleteCustomVcl',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/vcl/{vcl_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a custom VCL file',
  'description' => 'Delete a custom VCL file',
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

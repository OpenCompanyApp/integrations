<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Set a custom VCL file as main
 *
 * Maps to Fastly generated client operation VclApi::setCustomVclMain (PUT /service/{service_id}/version/{version_id}/vcl/{vcl_name}/main).
 */
class FastlyVclSetCustomVclMain extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_set_custom_vcl_main';
    protected const DESCRIPTION = 'Set a custom VCL file as main

Official Fastly client operation: VclApi::setCustomVclMain
Endpoint: PUT /service/{service_id}/version/{version_id}/vcl/{vcl_name}/main

Set a custom VCL file as main';
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
  'slug' => 'fastly_vcl_set_custom_vcl_main',
  'class' => 'FastlyVclSetCustomVclMain',
  'api_class' => 'VclApi',
  'method_name' => 'setCustomVclMain',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/vcl/{vcl_name}/main',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Set a custom VCL file as main',
  'description' => 'Set a custom VCL file as main',
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

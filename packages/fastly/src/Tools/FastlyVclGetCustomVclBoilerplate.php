<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get boilerplate VCL
 *
 * Maps to Fastly generated client operation VclApi::getCustomVclBoilerplate (GET /service/{service_id}/version/{version_id}/boilerplate).
 */
class FastlyVclGetCustomVclBoilerplate extends AbstractFastlyTool
{
    protected const NAME = 'fastly_vcl_get_custom_vcl_boilerplate';
    protected const DESCRIPTION = 'Get boilerplate VCL

Official Fastly client operation: VclApi::getCustomVclBoilerplate
Endpoint: GET /service/{service_id}/version/{version_id}/boilerplate

Get boilerplate VCL';
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
  'slug' => 'fastly_vcl_get_custom_vcl_boilerplate',
  'class' => 'FastlyVclGetCustomVclBoilerplate',
  'api_class' => 'VclApi',
  'method_name' => 'getCustomVclBoilerplate',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/boilerplate',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get boilerplate VCL',
  'description' => 'Get boilerplate VCL',
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

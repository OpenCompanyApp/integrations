<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List backends
 *
 * Maps to Fastly generated client operation BackendApi::listBackends (GET /service/{service_id}/version/{version_id}/backend).
 */
class FastlyBackendListBackends extends AbstractFastlyTool
{
    protected const NAME = 'fastly_backend_list_backends';
    protected const DESCRIPTION = 'List backends

Official Fastly client operation: BackendApi::listBackends
Endpoint: GET /service/{service_id}/version/{version_id}/backend

List backends';
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
  'slug' => 'fastly_backend_list_backends',
  'class' => 'FastlyBackendListBackends',
  'api_class' => 'BackendApi',
  'method_name' => 'listBackends',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/backend',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List backends',
  'description' => 'List backends',
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

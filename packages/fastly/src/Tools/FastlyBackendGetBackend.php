<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Describe a backend
 *
 * Maps to Fastly generated client operation BackendApi::getBackend (GET /service/{service_id}/version/{version_id}/backend/{backend_name}).
 */
class FastlyBackendGetBackend extends AbstractFastlyTool
{
    protected const NAME = 'fastly_backend_get_backend';
    protected const DESCRIPTION = 'Describe a backend

Official Fastly client operation: BackendApi::getBackend
Endpoint: GET /service/{service_id}/version/{version_id}/backend/{backend_name}

Describe a backend';
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
  'backend_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `backend_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_backend_get_backend',
  'class' => 'FastlyBackendGetBackend',
  'api_class' => 'BackendApi',
  'method_name' => 'getBackend',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/backend/{backend_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Describe a backend',
  'description' => 'Describe a backend',
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
    'backend_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `backend_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'backend_name' => 'backend_name',
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

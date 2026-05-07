<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a backend
 *
 * Maps to Fastly generated client operation BackendApi::deleteBackend (DELETE /service/{service_id}/version/{version_id}/backend/{backend_name}).
 */
class FastlyBackendDeleteBackend extends AbstractFastlyTool
{
    protected const NAME = 'fastly_backend_delete_backend';
    protected const DESCRIPTION = 'Delete a backend

Official Fastly client operation: BackendApi::deleteBackend
Endpoint: DELETE /service/{service_id}/version/{version_id}/backend/{backend_name}

Delete a backend';
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
  'slug' => 'fastly_backend_delete_backend',
  'class' => 'FastlyBackendDeleteBackend',
  'api_class' => 'BackendApi',
  'method_name' => 'deleteBackend',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/backend/{backend_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a backend',
  'description' => 'Delete a backend',
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

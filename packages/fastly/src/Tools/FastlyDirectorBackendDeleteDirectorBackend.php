<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a director-backend relationship
 *
 * Maps to Fastly generated client operation DirectorBackendApi::deleteDirectorBackend (DELETE /service/{service_id}/version/{version_id}/director/{director_name}/backend/{backend_name}).
 */
class FastlyDirectorBackendDeleteDirectorBackend extends AbstractFastlyTool
{
    protected const NAME = 'fastly_director_backend_delete_director_backend';
    protected const DESCRIPTION = 'Delete a director-backend relationship

Official Fastly client operation: DirectorBackendApi::deleteDirectorBackend
Endpoint: DELETE /service/{service_id}/version/{version_id}/director/{director_name}/backend/{backend_name}

Delete a director-backend relationship';
    protected const PARAMETERS = array (
  'director_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `director_name`.',
  ),
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
  'slug' => 'fastly_director_backend_delete_director_backend',
  'class' => 'FastlyDirectorBackendDeleteDirectorBackend',
  'api_class' => 'DirectorBackendApi',
  'method_name' => 'deleteDirectorBackend',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/director/{director_name}/backend/{backend_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a director-backend relationship',
  'description' => 'Delete a director-backend relationship',
  'type' => 'write',
  'parameters' =>
  array (
    'director_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `director_name`.',
    ),
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
    'director_name' => 'director_name',
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

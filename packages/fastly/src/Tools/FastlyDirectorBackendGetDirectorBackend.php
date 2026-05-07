<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a director-backend relationship
 *
 * Maps to Fastly generated client operation DirectorBackendApi::getDirectorBackend (GET /service/{service_id}/version/{version_id}/director/{director_name}/backend/{backend_name}).
 */
class FastlyDirectorBackendGetDirectorBackend extends AbstractFastlyTool
{
    protected const NAME = 'fastly_director_backend_get_director_backend';
    protected const DESCRIPTION = 'Get a director-backend relationship

Official Fastly client operation: DirectorBackendApi::getDirectorBackend
Endpoint: GET /service/{service_id}/version/{version_id}/director/{director_name}/backend/{backend_name}

Get a director-backend relationship';
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
  'slug' => 'fastly_director_backend_get_director_backend',
  'class' => 'FastlyDirectorBackendGetDirectorBackend',
  'api_class' => 'DirectorBackendApi',
  'method_name' => 'getDirectorBackend',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/director/{director_name}/backend/{backend_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a director-backend relationship',
  'description' => 'Get a director-backend relationship',
  'type' => 'read',
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

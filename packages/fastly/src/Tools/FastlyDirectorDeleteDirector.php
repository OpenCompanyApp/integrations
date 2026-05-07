<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a director
 *
 * Maps to Fastly generated client operation DirectorApi::deleteDirector (DELETE /service/{service_id}/version/{version_id}/director/{director_name}).
 */
class FastlyDirectorDeleteDirector extends AbstractFastlyTool
{
    protected const NAME = 'fastly_director_delete_director';
    protected const DESCRIPTION = 'Delete a director

Official Fastly client operation: DirectorApi::deleteDirector
Endpoint: DELETE /service/{service_id}/version/{version_id}/director/{director_name}

Delete a director';
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
  'director_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `director_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_director_delete_director',
  'class' => 'FastlyDirectorDeleteDirector',
  'api_class' => 'DirectorApi',
  'method_name' => 'deleteDirector',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/director/{director_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a director',
  'description' => 'Delete a director',
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
    'director_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `director_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'director_name' => 'director_name',
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

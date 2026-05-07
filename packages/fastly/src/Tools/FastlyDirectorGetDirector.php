<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a director
 *
 * Maps to Fastly generated client operation DirectorApi::getDirector (GET /service/{service_id}/version/{version_id}/director/{director_name}).
 */
class FastlyDirectorGetDirector extends AbstractFastlyTool
{
    protected const NAME = 'fastly_director_get_director';
    protected const DESCRIPTION = 'Get a director

Official Fastly client operation: DirectorApi::getDirector
Endpoint: GET /service/{service_id}/version/{version_id}/director/{director_name}

Get a director';
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
  'slug' => 'fastly_director_get_director',
  'class' => 'FastlyDirectorGetDirector',
  'api_class' => 'DirectorApi',
  'method_name' => 'getDirector',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/director/{director_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a director',
  'description' => 'Get a director',
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

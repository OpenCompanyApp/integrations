<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List directors
 *
 * Maps to Fastly generated client operation DirectorApi::listDirectors (GET /service/{service_id}/version/{version_id}/director).
 */
class FastlyDirectorListDirectors extends AbstractFastlyTool
{
    protected const NAME = 'fastly_director_list_directors';
    protected const DESCRIPTION = 'List directors

Official Fastly client operation: DirectorApi::listDirectors
Endpoint: GET /service/{service_id}/version/{version_id}/director

List directors';
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
  'slug' => 'fastly_director_list_directors',
  'class' => 'FastlyDirectorListDirectors',
  'api_class' => 'DirectorApi',
  'method_name' => 'listDirectors',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/director',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List directors',
  'description' => 'List directors',
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

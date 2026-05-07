<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a director
 *
 * Maps to Fastly generated client operation DirectorApi::createDirector (POST /service/{service_id}/version/{version_id}/director).
 */
class FastlyDirectorCreateDirector extends AbstractFastlyTool
{
    protected const NAME = 'fastly_director_create_director';
    protected const DESCRIPTION = 'Create a director

Official Fastly client operation: DirectorApi::createDirector
Endpoint: POST /service/{service_id}/version/{version_id}/director

Create a director';
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
  'backends' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `backends`.',
  ),
  'capacity' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `capacity`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'quorum' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `quorum`.',
  ),
  'shield' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `shield`.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `type`.',
  ),
  'retries' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `retries`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_director_create_director',
  'class' => 'FastlyDirectorCreateDirector',
  'api_class' => 'DirectorApi',
  'method_name' => 'createDirector',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/director',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a director',
  'description' => 'Create a director',
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
    'backends' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `backends`.',
    ),
    'capacity' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `capacity`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'quorum' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `quorum`.',
    ),
    'shield' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `shield`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `type`.',
    ),
    'retries' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `retries`.',
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
    'backends' => 'backends',
    'capacity' => 'capacity',
    'comment' => 'comment',
    'name' => 'name',
    'quorum' => 'quorum',
    'shield' => 'shield',
    'type' => 'type',
    'retries' => 'retries',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

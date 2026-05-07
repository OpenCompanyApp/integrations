<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a service version
 *
 * Maps to Fastly generated client operation VersionApi::updateServiceVersion (PUT /service/{service_id}/version/{version_id}).
 */
class FastlyVersionUpdateServiceVersion extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_update_service_version';
    protected const DESCRIPTION = 'Update a service version

Official Fastly client operation: VersionApi::updateServiceVersion
Endpoint: PUT /service/{service_id}/version/{version_id}

Update a service version';
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
  'active' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `active`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'deployed' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `deployed`.',
  ),
  'locked' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `locked`.',
  ),
  'number' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `number`.',
  ),
  'staging' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `staging`.',
  ),
  'testing' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `testing`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_version_update_service_version',
  'class' => 'FastlyVersionUpdateServiceVersion',
  'api_class' => 'VersionApi',
  'method_name' => 'updateServiceVersion',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a service version',
  'description' => 'Update a service version',
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
    'active' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `active`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'deployed' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `deployed`.',
    ),
    'locked' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `locked`.',
    ),
    'number' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `number`.',
    ),
    'staging' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `staging`.',
    ),
    'testing' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `testing`.',
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
    'active' => 'active',
    'comment' => 'comment',
    'deployed' => 'deployed',
    'locked' => 'locked',
    'number' => 'number',
    'staging' => 'staging',
    'testing' => 'testing',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

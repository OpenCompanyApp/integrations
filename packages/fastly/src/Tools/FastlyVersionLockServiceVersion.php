<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Lock a service version
 *
 * Maps to Fastly generated client operation VersionApi::lockServiceVersion (PUT /service/{service_id}/version/{version_id}/lock).
 */
class FastlyVersionLockServiceVersion extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_lock_service_version';
    protected const DESCRIPTION = 'Lock a service version

Official Fastly client operation: VersionApi::lockServiceVersion
Endpoint: PUT /service/{service_id}/version/{version_id}/lock

Lock a service version';
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
  'slug' => 'fastly_version_lock_service_version',
  'class' => 'FastlyVersionLockServiceVersion',
  'api_class' => 'VersionApi',
  'method_name' => 'lockServiceVersion',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/lock',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Lock a service version',
  'description' => 'Lock a service version',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Clone a service version
 *
 * Maps to Fastly generated client operation VersionApi::cloneServiceVersion (PUT /service/{service_id}/version/{version_id}/clone).
 */
class FastlyVersionCloneServiceVersion extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_clone_service_version';
    protected const DESCRIPTION = 'Clone a service version

Official Fastly client operation: VersionApi::cloneServiceVersion
Endpoint: PUT /service/{service_id}/version/{version_id}/clone

Clone a service version';
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
  'slug' => 'fastly_version_clone_service_version',
  'class' => 'FastlyVersionCloneServiceVersion',
  'api_class' => 'VersionApi',
  'method_name' => 'cloneServiceVersion',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/clone',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Clone a service version',
  'description' => 'Clone a service version',
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

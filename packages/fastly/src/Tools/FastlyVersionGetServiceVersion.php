<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a version of a service
 *
 * Maps to Fastly generated client operation VersionApi::getServiceVersion (GET /service/{service_id}/version/{version_id}).
 */
class FastlyVersionGetServiceVersion extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_get_service_version';
    protected const DESCRIPTION = 'Get a version of a service

Official Fastly client operation: VersionApi::getServiceVersion
Endpoint: GET /service/{service_id}/version/{version_id}

Get a version of a service';
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
  'slug' => 'fastly_version_get_service_version',
  'class' => 'FastlyVersionGetServiceVersion',
  'api_class' => 'VersionApi',
  'method_name' => 'getServiceVersion',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a version of a service',
  'description' => 'Get a version of a service',
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

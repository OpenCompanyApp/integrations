<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Activate a service version
 *
 * Maps to Fastly generated client operation VersionApi::activateServiceVersion (PUT /service/{service_id}/version/{version_id}/activate).
 */
class FastlyVersionActivateServiceVersion extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_activate_service_version';
    protected const DESCRIPTION = 'Activate a service version

Official Fastly client operation: VersionApi::activateServiceVersion
Endpoint: PUT /service/{service_id}/version/{version_id}/activate

Activate a service version';
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
  'slug' => 'fastly_version_activate_service_version',
  'class' => 'FastlyVersionActivateServiceVersion',
  'api_class' => 'VersionApi',
  'method_name' => 'activateServiceVersion',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/activate',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Activate a service version',
  'description' => 'Activate a service version',
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

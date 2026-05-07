<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Deactivate a service version
 *
 * Maps to Fastly generated client operation VersionApi::deactivateServiceVersion (PUT /service/{service_id}/version/{version_id}/deactivate).
 */
class FastlyVersionDeactivateServiceVersion extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_deactivate_service_version';
    protected const DESCRIPTION = 'Deactivate a service version

Official Fastly client operation: VersionApi::deactivateServiceVersion
Endpoint: PUT /service/{service_id}/version/{version_id}/deactivate

Deactivate a service version';
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
  'slug' => 'fastly_version_deactivate_service_version',
  'class' => 'FastlyVersionDeactivateServiceVersion',
  'api_class' => 'VersionApi',
  'method_name' => 'deactivateServiceVersion',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/deactivate',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Deactivate a service version',
  'description' => 'Deactivate a service version',
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

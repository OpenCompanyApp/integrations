<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Validate a service version
 *
 * Maps to Fastly generated client operation VersionApi::validateServiceVersion (GET /service/{service_id}/version/{version_id}/validate).
 */
class FastlyVersionValidateServiceVersion extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_validate_service_version';
    protected const DESCRIPTION = 'Validate a service version

Official Fastly client operation: VersionApi::validateServiceVersion
Endpoint: GET /service/{service_id}/version/{version_id}/validate

Validate a service version';
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
  'slug' => 'fastly_version_validate_service_version',
  'class' => 'FastlyVersionValidateServiceVersion',
  'api_class' => 'VersionApi',
  'method_name' => 'validateServiceVersion',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/validate',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Validate a service version',
  'description' => 'Validate a service version',
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

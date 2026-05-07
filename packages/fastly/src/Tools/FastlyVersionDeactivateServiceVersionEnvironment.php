<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Deactivate a service version on an environment
 *
 * Maps to Fastly generated client operation VersionApi::deactivateServiceVersionEnvironment (PUT /service/{service_id}/version/{version_id}/deactivate/{environment_name}).
 */
class FastlyVersionDeactivateServiceVersionEnvironment extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_deactivate_service_version_environment';
    protected const DESCRIPTION = 'Deactivate a service version on an environment

Official Fastly client operation: VersionApi::deactivateServiceVersionEnvironment
Endpoint: PUT /service/{service_id}/version/{version_id}/deactivate/{environment_name}

Deactivate a service version on an environment';
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
  'environment_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `environment_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_version_deactivate_service_version_environment',
  'class' => 'FastlyVersionDeactivateServiceVersionEnvironment',
  'api_class' => 'VersionApi',
  'method_name' => 'deactivateServiceVersionEnvironment',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/deactivate/{environment_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Deactivate a service version on an environment',
  'description' => 'Deactivate a service version on an environment',
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
    'environment_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `environment_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'environment_name' => 'environment_name',
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

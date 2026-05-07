<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Activate a service version on the specified environment
 *
 * Maps to Fastly generated client operation VersionApi::activateServiceVersionEnvironment (PUT /service/{service_id}/version/{version_id}/activate/{environment_name}).
 */
class FastlyVersionActivateServiceVersionEnvironment extends AbstractFastlyTool
{
    protected const NAME = 'fastly_version_activate_service_version_environment';
    protected const DESCRIPTION = 'Activate a service version on the specified environment

Official Fastly client operation: VersionApi::activateServiceVersionEnvironment
Endpoint: PUT /service/{service_id}/version/{version_id}/activate/{environment_name}

Activate a service version on the specified environment';
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
  'slug' => 'fastly_version_activate_service_version_environment',
  'class' => 'FastlyVersionActivateServiceVersionEnvironment',
  'api_class' => 'VersionApi',
  'method_name' => 'activateServiceVersionEnvironment',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/activate/{environment_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Activate a service version on the specified environment',
  'description' => 'Activate a service version on the specified environment',
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

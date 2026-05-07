<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a health check
 *
 * Maps to Fastly generated client operation HealthcheckApi::getHealthcheck (GET /service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}).
 */
class FastlyHealthcheckGetHealthcheck extends AbstractFastlyTool
{
    protected const NAME = 'fastly_healthcheck_get_healthcheck';
    protected const DESCRIPTION = 'Get a health check

Official Fastly client operation: HealthcheckApi::getHealthcheck
Endpoint: GET /service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}

Get a health check';
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
  'healthcheck_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `healthcheck_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_healthcheck_get_healthcheck',
  'class' => 'FastlyHealthcheckGetHealthcheck',
  'api_class' => 'HealthcheckApi',
  'method_name' => 'getHealthcheck',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a health check',
  'description' => 'Get a health check',
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
    'healthcheck_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `healthcheck_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'healthcheck_name' => 'healthcheck_name',
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

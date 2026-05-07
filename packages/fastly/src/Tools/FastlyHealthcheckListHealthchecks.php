<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List health checks
 *
 * Maps to Fastly generated client operation HealthcheckApi::listHealthchecks (GET /service/{service_id}/version/{version_id}/healthcheck).
 */
class FastlyHealthcheckListHealthchecks extends AbstractFastlyTool
{
    protected const NAME = 'fastly_healthcheck_list_healthchecks';
    protected const DESCRIPTION = 'List health checks

Official Fastly client operation: HealthcheckApi::listHealthchecks
Endpoint: GET /service/{service_id}/version/{version_id}/healthcheck

List health checks';
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
  'slug' => 'fastly_healthcheck_list_healthchecks',
  'class' => 'FastlyHealthcheckListHealthchecks',
  'api_class' => 'HealthcheckApi',
  'method_name' => 'listHealthchecks',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/healthcheck',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List health checks',
  'description' => 'List health checks',
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

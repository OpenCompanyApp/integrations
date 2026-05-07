<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a health check
 *
 * Maps to Fastly generated client operation HealthcheckApi::deleteHealthcheck (DELETE /service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}).
 */
class FastlyHealthcheckDeleteHealthcheck extends AbstractFastlyTool
{
    protected const NAME = 'fastly_healthcheck_delete_healthcheck';
    protected const DESCRIPTION = 'Delete a health check

Official Fastly client operation: HealthcheckApi::deleteHealthcheck
Endpoint: DELETE /service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}

Delete a health check';
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
  'slug' => 'fastly_healthcheck_delete_healthcheck',
  'class' => 'FastlyHealthcheckDeleteHealthcheck',
  'api_class' => 'HealthcheckApi',
  'method_name' => 'deleteHealthcheck',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a health check',
  'description' => 'Delete a health check',
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

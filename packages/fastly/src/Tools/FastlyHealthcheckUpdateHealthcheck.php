<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a health check
 *
 * Maps to Fastly generated client operation HealthcheckApi::updateHealthcheck (PUT /service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}).
 */
class FastlyHealthcheckUpdateHealthcheck extends AbstractFastlyTool
{
    protected const NAME = 'fastly_healthcheck_update_healthcheck';
    protected const DESCRIPTION = 'Update a health check

Official Fastly client operation: HealthcheckApi::updateHealthcheck
Endpoint: PUT /service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}

Update a health check';
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
  'check_interval' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `check_interval`.',
  ),
  'comment' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `comment`.',
  ),
  'expected_response' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `expected_response`.',
  ),
  'headers' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `headers`.',
  ),
  'host' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `host`.',
  ),
  'http_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `http_version`.',
  ),
  'initial' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `initial`.',
  ),
  'method' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `method`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'path' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `path`.',
  ),
  'threshold' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `threshold`.',
  ),
  'timeout' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `timeout`.',
  ),
  'window' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `window`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_healthcheck_update_healthcheck',
  'class' => 'FastlyHealthcheckUpdateHealthcheck',
  'api_class' => 'HealthcheckApi',
  'method_name' => 'updateHealthcheck',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/healthcheck/{healthcheck_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a health check',
  'description' => 'Update a health check',
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
    'check_interval' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `check_interval`.',
    ),
    'comment' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `comment`.',
    ),
    'expected_response' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `expected_response`.',
    ),
    'headers' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `headers`.',
    ),
    'host' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `host`.',
    ),
    'http_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `http_version`.',
    ),
    'initial' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `initial`.',
    ),
    'method' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `method`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'path' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `path`.',
    ),
    'threshold' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `threshold`.',
    ),
    'timeout' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `timeout`.',
    ),
    'window' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `window`.',
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
    'check_interval' => 'check_interval',
    'comment' => 'comment',
    'expected_response' => 'expected_response',
    'headers' => 'headers',
    'host' => 'host',
    'http_version' => 'http_version',
    'initial' => 'initial',
    'method' => 'method',
    'name' => 'name',
    'path' => 'path',
    'threshold' => 'threshold',
    'timeout' => 'timeout',
    'window' => 'window',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

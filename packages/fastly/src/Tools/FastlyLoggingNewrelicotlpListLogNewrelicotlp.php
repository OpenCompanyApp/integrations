<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List New Relic OTLP endpoints
 *
 * Maps to Fastly generated client operation LoggingNewrelicotlpApi::listLogNewrelicotlp (GET /service/{service_id}/version/{version_id}/logging/newrelicotlp).
 */
class FastlyLoggingNewrelicotlpListLogNewrelicotlp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_newrelicotlp_list_log_newrelicotlp';
    protected const DESCRIPTION = 'List New Relic OTLP endpoints

Official Fastly client operation: LoggingNewrelicotlpApi::listLogNewrelicotlp
Endpoint: GET /service/{service_id}/version/{version_id}/logging/newrelicotlp

List New Relic OTLP endpoints';
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
  'slug' => 'fastly_logging_newrelicotlp_list_log_newrelicotlp',
  'class' => 'FastlyLoggingNewrelicotlpListLogNewrelicotlp',
  'api_class' => 'LoggingNewrelicotlpApi',
  'method_name' => 'listLogNewrelicotlp',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/newrelicotlp',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List New Relic OTLP endpoints',
  'description' => 'List New Relic OTLP endpoints',
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

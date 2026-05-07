<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Datadog log endpoints
 *
 * Maps to Fastly generated client operation LoggingDatadogApi::listLogDatadog (GET /service/{service_id}/version/{version_id}/logging/datadog).
 */
class FastlyLoggingDatadogListLogDatadog extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_datadog_list_log_datadog';
    protected const DESCRIPTION = 'List Datadog log endpoints

Official Fastly client operation: LoggingDatadogApi::listLogDatadog
Endpoint: GET /service/{service_id}/version/{version_id}/logging/datadog

List Datadog log endpoints';
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
  'slug' => 'fastly_logging_datadog_list_log_datadog',
  'class' => 'FastlyLoggingDatadogListLogDatadog',
  'api_class' => 'LoggingDatadogApi',
  'method_name' => 'listLogDatadog',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/datadog',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Datadog log endpoints',
  'description' => 'List Datadog log endpoints',
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

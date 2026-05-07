<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a Datadog log endpoint
 *
 * Maps to Fastly generated client operation LoggingDatadogApi::deleteLogDatadog (DELETE /service/{service_id}/version/{version_id}/logging/datadog/{logging_datadog_name}).
 */
class FastlyLoggingDatadogDeleteLogDatadog extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_datadog_delete_log_datadog';
    protected const DESCRIPTION = 'Delete a Datadog log endpoint

Official Fastly client operation: LoggingDatadogApi::deleteLogDatadog
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/datadog/{logging_datadog_name}

Delete a Datadog log endpoint';
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
  'logging_datadog_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_datadog_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_datadog_delete_log_datadog',
  'class' => 'FastlyLoggingDatadogDeleteLogDatadog',
  'api_class' => 'LoggingDatadogApi',
  'method_name' => 'deleteLogDatadog',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/datadog/{logging_datadog_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a Datadog log endpoint',
  'description' => 'Delete a Datadog log endpoint',
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
    'logging_datadog_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_datadog_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_datadog_name' => 'logging_datadog_name',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a Sumologic log endpoint
 *
 * Maps to Fastly generated client operation LoggingSumologicApi::deleteLogSumologic (DELETE /service/{service_id}/version/{version_id}/logging/sumologic/{logging_sumologic_name}).
 */
class FastlyLoggingSumologicDeleteLogSumologic extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_sumologic_delete_log_sumologic';
    protected const DESCRIPTION = 'Delete a Sumologic log endpoint

Official Fastly client operation: LoggingSumologicApi::deleteLogSumologic
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/sumologic/{logging_sumologic_name}

Delete a Sumologic log endpoint';
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
  'logging_sumologic_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_sumologic_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_sumologic_delete_log_sumologic',
  'class' => 'FastlyLoggingSumologicDeleteLogSumologic',
  'api_class' => 'LoggingSumologicApi',
  'method_name' => 'deleteLogSumologic',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/sumologic/{logging_sumologic_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a Sumologic log endpoint',
  'description' => 'Delete a Sumologic log endpoint',
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
    'logging_sumologic_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_sumologic_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_sumologic_name' => 'logging_sumologic_name',
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

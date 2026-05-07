<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Sumologic log endpoint
 *
 * Maps to Fastly generated client operation LoggingSumologicApi::getLogSumologic (GET /service/{service_id}/version/{version_id}/logging/sumologic/{logging_sumologic_name}).
 */
class FastlyLoggingSumologicGetLogSumologic extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_sumologic_get_log_sumologic';
    protected const DESCRIPTION = 'Get a Sumologic log endpoint

Official Fastly client operation: LoggingSumologicApi::getLogSumologic
Endpoint: GET /service/{service_id}/version/{version_id}/logging/sumologic/{logging_sumologic_name}

Get a Sumologic log endpoint';
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
  'slug' => 'fastly_logging_sumologic_get_log_sumologic',
  'class' => 'FastlyLoggingSumologicGetLogSumologic',
  'api_class' => 'LoggingSumologicApi',
  'method_name' => 'getLogSumologic',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/sumologic/{logging_sumologic_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Sumologic log endpoint',
  'description' => 'Get a Sumologic log endpoint',
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

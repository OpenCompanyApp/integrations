<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Sumologic log endpoints
 *
 * Maps to Fastly generated client operation LoggingSumologicApi::listLogSumologic (GET /service/{service_id}/version/{version_id}/logging/sumologic).
 */
class FastlyLoggingSumologicListLogSumologic extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_sumologic_list_log_sumologic';
    protected const DESCRIPTION = 'List Sumologic log endpoints

Official Fastly client operation: LoggingSumologicApi::listLogSumologic
Endpoint: GET /service/{service_id}/version/{version_id}/logging/sumologic

List Sumologic log endpoints';
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
  'slug' => 'fastly_logging_sumologic_list_log_sumologic',
  'class' => 'FastlyLoggingSumologicListLogSumologic',
  'api_class' => 'LoggingSumologicApi',
  'method_name' => 'listLogSumologic',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/sumologic',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Sumologic log endpoints',
  'description' => 'List Sumologic log endpoints',
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

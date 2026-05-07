<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a BigQuery log endpoint
 *
 * Maps to Fastly generated client operation LoggingBigqueryApi::getLogBigquery (GET /service/{service_id}/version/{version_id}/logging/bigquery/{logging_bigquery_name}).
 */
class FastlyLoggingBigqueryGetLogBigquery extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_bigquery_get_log_bigquery';
    protected const DESCRIPTION = 'Get a BigQuery log endpoint

Official Fastly client operation: LoggingBigqueryApi::getLogBigquery
Endpoint: GET /service/{service_id}/version/{version_id}/logging/bigquery/{logging_bigquery_name}

Get a BigQuery log endpoint';
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
  'logging_bigquery_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_bigquery_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_bigquery_get_log_bigquery',
  'class' => 'FastlyLoggingBigqueryGetLogBigquery',
  'api_class' => 'LoggingBigqueryApi',
  'method_name' => 'getLogBigquery',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/bigquery/{logging_bigquery_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a BigQuery log endpoint',
  'description' => 'Get a BigQuery log endpoint',
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
    'logging_bigquery_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_bigquery_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_bigquery_name' => 'logging_bigquery_name',
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

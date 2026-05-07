<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a BigQuery log endpoint
 *
 * Maps to Fastly generated client operation LoggingBigqueryApi::deleteLogBigquery (DELETE /service/{service_id}/version/{version_id}/logging/bigquery/{logging_bigquery_name}).
 */
class FastlyLoggingBigqueryDeleteLogBigquery extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_bigquery_delete_log_bigquery';
    protected const DESCRIPTION = 'Delete a BigQuery log endpoint

Official Fastly client operation: LoggingBigqueryApi::deleteLogBigquery
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/bigquery/{logging_bigquery_name}

Delete a BigQuery log endpoint';
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
  'slug' => 'fastly_logging_bigquery_delete_log_bigquery',
  'class' => 'FastlyLoggingBigqueryDeleteLogBigquery',
  'api_class' => 'LoggingBigqueryApi',
  'method_name' => 'deleteLogBigquery',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/bigquery/{logging_bigquery_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a BigQuery log endpoint',
  'description' => 'Delete a BigQuery log endpoint',
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

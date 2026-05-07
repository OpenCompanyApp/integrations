<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List BigQuery log endpoints
 *
 * Maps to Fastly generated client operation LoggingBigqueryApi::listLogBigquery (GET /service/{service_id}/version/{version_id}/logging/bigquery).
 */
class FastlyLoggingBigqueryListLogBigquery extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_bigquery_list_log_bigquery';
    protected const DESCRIPTION = 'List BigQuery log endpoints

Official Fastly client operation: LoggingBigqueryApi::listLogBigquery
Endpoint: GET /service/{service_id}/version/{version_id}/logging/bigquery

List BigQuery log endpoints';
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
  'slug' => 'fastly_logging_bigquery_list_log_bigquery',
  'class' => 'FastlyLoggingBigqueryListLogBigquery',
  'api_class' => 'LoggingBigqueryApi',
  'method_name' => 'listLogBigquery',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/bigquery',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List BigQuery log endpoints',
  'description' => 'List BigQuery log endpoints',
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

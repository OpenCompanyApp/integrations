<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a BigQuery log endpoint
 *
 * Maps to Fastly generated client operation LoggingBigqueryApi::createLogBigquery (POST /service/{service_id}/version/{version_id}/logging/bigquery).
 */
class FastlyLoggingBigqueryCreateLogBigquery extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_bigquery_create_log_bigquery';
    protected const DESCRIPTION = 'Create a BigQuery log endpoint

Official Fastly client operation: LoggingBigqueryApi::createLogBigquery
Endpoint: POST /service/{service_id}/version/{version_id}/logging/bigquery

Create a BigQuery log endpoint';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'placement' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `placement`.',
  ),
  'response_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `response_condition`.',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format`.',
  ),
  'log_processing_region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `log_processing_region`.',
  ),
  'format_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format_version`.',
  ),
  'user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `user`.',
  ),
  'secret_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `secret_key`.',
  ),
  'account_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `account_name`.',
  ),
  'dataset' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `dataset`.',
  ),
  'table' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `table`.',
  ),
  'template_suffix' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `template_suffix`.',
  ),
  'project_id' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `project_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_bigquery_create_log_bigquery',
  'class' => 'FastlyLoggingBigqueryCreateLogBigquery',
  'api_class' => 'LoggingBigqueryApi',
  'method_name' => 'createLogBigquery',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/logging/bigquery',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a BigQuery log endpoint',
  'description' => 'Create a BigQuery log endpoint',
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
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'placement' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `placement`.',
    ),
    'response_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `response_condition`.',
    ),
    'format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format`.',
    ),
    'log_processing_region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `log_processing_region`.',
    ),
    'format_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format_version`.',
    ),
    'user' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `user`.',
    ),
    'secret_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `secret_key`.',
    ),
    'account_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `account_name`.',
    ),
    'dataset' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `dataset`.',
    ),
    'table' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `table`.',
    ),
    'template_suffix' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `template_suffix`.',
    ),
    'project_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `project_id`.',
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
    'name' => 'name',
    'placement' => 'placement',
    'response_condition' => 'response_condition',
    'format' => 'format',
    'log_processing_region' => 'log_processing_region',
    'format_version' => 'format_version',
    'user' => 'user',
    'secret_key' => 'secret_key',
    'account_name' => 'account_name',
    'dataset' => 'dataset',
    'table' => 'table',
    'template_suffix' => 'template_suffix',
    'project_id' => 'project_id',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

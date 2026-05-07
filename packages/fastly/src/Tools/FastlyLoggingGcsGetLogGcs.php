<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a GCS log endpoint
 *
 * Maps to Fastly generated client operation LoggingGcsApi::getLogGcs (GET /service/{service_id}/version/{version_id}/logging/gcs/{logging_gcs_name}).
 */
class FastlyLoggingGcsGetLogGcs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_gcs_get_log_gcs';
    protected const DESCRIPTION = 'Get a GCS log endpoint

Official Fastly client operation: LoggingGcsApi::getLogGcs
Endpoint: GET /service/{service_id}/version/{version_id}/logging/gcs/{logging_gcs_name}

Get a GCS log endpoint';
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
  'logging_gcs_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_gcs_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_gcs_get_log_gcs',
  'class' => 'FastlyLoggingGcsGetLogGcs',
  'api_class' => 'LoggingGcsApi',
  'method_name' => 'getLogGcs',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/gcs/{logging_gcs_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a GCS log endpoint',
  'description' => 'Get a GCS log endpoint',
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
    'logging_gcs_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_gcs_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_gcs_name' => 'logging_gcs_name',
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

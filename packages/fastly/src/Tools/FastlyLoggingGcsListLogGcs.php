<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List GCS log endpoints
 *
 * Maps to Fastly generated client operation LoggingGcsApi::listLogGcs (GET /service/{service_id}/version/{version_id}/logging/gcs).
 */
class FastlyLoggingGcsListLogGcs extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_gcs_list_log_gcs';
    protected const DESCRIPTION = 'List GCS log endpoints

Official Fastly client operation: LoggingGcsApi::listLogGcs
Endpoint: GET /service/{service_id}/version/{version_id}/logging/gcs

List GCS log endpoints';
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
  'slug' => 'fastly_logging_gcs_list_log_gcs',
  'class' => 'FastlyLoggingGcsListLogGcs',
  'api_class' => 'LoggingGcsApi',
  'method_name' => 'listLogGcs',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/gcs',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List GCS log endpoints',
  'description' => 'List GCS log endpoints',
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

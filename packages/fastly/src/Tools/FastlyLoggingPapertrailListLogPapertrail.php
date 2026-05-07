<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Papertrail log endpoints
 *
 * Maps to Fastly generated client operation LoggingPapertrailApi::listLogPapertrail (GET /service/{service_id}/version/{version_id}/logging/papertrail).
 */
class FastlyLoggingPapertrailListLogPapertrail extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_papertrail_list_log_papertrail';
    protected const DESCRIPTION = 'List Papertrail log endpoints

Official Fastly client operation: LoggingPapertrailApi::listLogPapertrail
Endpoint: GET /service/{service_id}/version/{version_id}/logging/papertrail

List Papertrail log endpoints';
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
  'slug' => 'fastly_logging_papertrail_list_log_papertrail',
  'class' => 'FastlyLoggingPapertrailListLogPapertrail',
  'api_class' => 'LoggingPapertrailApi',
  'method_name' => 'listLogPapertrail',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/papertrail',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Papertrail log endpoints',
  'description' => 'List Papertrail log endpoints',
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

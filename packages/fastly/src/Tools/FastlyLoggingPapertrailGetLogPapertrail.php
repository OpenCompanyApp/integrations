<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Papertrail log endpoint
 *
 * Maps to Fastly generated client operation LoggingPapertrailApi::getLogPapertrail (GET /service/{service_id}/version/{version_id}/logging/papertrail/{logging_papertrail_name}).
 */
class FastlyLoggingPapertrailGetLogPapertrail extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_papertrail_get_log_papertrail';
    protected const DESCRIPTION = 'Get a Papertrail log endpoint

Official Fastly client operation: LoggingPapertrailApi::getLogPapertrail
Endpoint: GET /service/{service_id}/version/{version_id}/logging/papertrail/{logging_papertrail_name}

Get a Papertrail log endpoint';
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
  'logging_papertrail_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_papertrail_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_papertrail_get_log_papertrail',
  'class' => 'FastlyLoggingPapertrailGetLogPapertrail',
  'api_class' => 'LoggingPapertrailApi',
  'method_name' => 'getLogPapertrail',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/papertrail/{logging_papertrail_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Papertrail log endpoint',
  'description' => 'Get a Papertrail log endpoint',
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
    'logging_papertrail_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_papertrail_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_papertrail_name' => 'logging_papertrail_name',
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

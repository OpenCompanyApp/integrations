<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an HTTPS log endpoint
 *
 * Maps to Fastly generated client operation LoggingHttpsApi::getLogHttps (GET /service/{service_id}/version/{version_id}/logging/https/{logging_https_name}).
 */
class FastlyLoggingHttpsGetLogHttps extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_https_get_log_https';
    protected const DESCRIPTION = 'Get an HTTPS log endpoint

Official Fastly client operation: LoggingHttpsApi::getLogHttps
Endpoint: GET /service/{service_id}/version/{version_id}/logging/https/{logging_https_name}

Get an HTTPS log endpoint';
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
  'logging_https_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_https_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_https_get_log_https',
  'class' => 'FastlyLoggingHttpsGetLogHttps',
  'api_class' => 'LoggingHttpsApi',
  'method_name' => 'getLogHttps',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/https/{logging_https_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an HTTPS log endpoint',
  'description' => 'Get an HTTPS log endpoint',
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
    'logging_https_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_https_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_https_name' => 'logging_https_name',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List HTTPS log endpoints
 *
 * Maps to Fastly generated client operation LoggingHttpsApi::listLogHttps (GET /service/{service_id}/version/{version_id}/logging/https).
 */
class FastlyLoggingHttpsListLogHttps extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_https_list_log_https';
    protected const DESCRIPTION = 'List HTTPS log endpoints

Official Fastly client operation: LoggingHttpsApi::listLogHttps
Endpoint: GET /service/{service_id}/version/{version_id}/logging/https

List HTTPS log endpoints';
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
  'slug' => 'fastly_logging_https_list_log_https',
  'class' => 'FastlyLoggingHttpsListLogHttps',
  'api_class' => 'LoggingHttpsApi',
  'method_name' => 'listLogHttps',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/https',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List HTTPS log endpoints',
  'description' => 'List HTTPS log endpoints',
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

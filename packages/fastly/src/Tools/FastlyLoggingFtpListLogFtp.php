<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List FTP log endpoints
 *
 * Maps to Fastly generated client operation LoggingFtpApi::listLogFtp (GET /service/{service_id}/version/{version_id}/logging/ftp).
 */
class FastlyLoggingFtpListLogFtp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_ftp_list_log_ftp';
    protected const DESCRIPTION = 'List FTP log endpoints

Official Fastly client operation: LoggingFtpApi::listLogFtp
Endpoint: GET /service/{service_id}/version/{version_id}/logging/ftp

List FTP log endpoints';
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
  'slug' => 'fastly_logging_ftp_list_log_ftp',
  'class' => 'FastlyLoggingFtpListLogFtp',
  'api_class' => 'LoggingFtpApi',
  'method_name' => 'listLogFtp',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/ftp',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List FTP log endpoints',
  'description' => 'List FTP log endpoints',
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

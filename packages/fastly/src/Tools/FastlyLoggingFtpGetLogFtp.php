<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an FTP log endpoint
 *
 * Maps to Fastly generated client operation LoggingFtpApi::getLogFtp (GET /service/{service_id}/version/{version_id}/logging/ftp/{logging_ftp_name}).
 */
class FastlyLoggingFtpGetLogFtp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_ftp_get_log_ftp';
    protected const DESCRIPTION = 'Get an FTP log endpoint

Official Fastly client operation: LoggingFtpApi::getLogFtp
Endpoint: GET /service/{service_id}/version/{version_id}/logging/ftp/{logging_ftp_name}

Get an FTP log endpoint';
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
  'logging_ftp_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_ftp_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_ftp_get_log_ftp',
  'class' => 'FastlyLoggingFtpGetLogFtp',
  'api_class' => 'LoggingFtpApi',
  'method_name' => 'getLogFtp',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/ftp/{logging_ftp_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an FTP log endpoint',
  'description' => 'Get an FTP log endpoint',
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
    'logging_ftp_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_ftp_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_ftp_name' => 'logging_ftp_name',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an SFTP log endpoint
 *
 * Maps to Fastly generated client operation LoggingSftpApi::getLogSftp (GET /service/{service_id}/version/{version_id}/logging/sftp/{logging_sftp_name}).
 */
class FastlyLoggingSftpGetLogSftp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_sftp_get_log_sftp';
    protected const DESCRIPTION = 'Get an SFTP log endpoint

Official Fastly client operation: LoggingSftpApi::getLogSftp
Endpoint: GET /service/{service_id}/version/{version_id}/logging/sftp/{logging_sftp_name}

Get an SFTP log endpoint';
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
  'logging_sftp_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_sftp_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_sftp_get_log_sftp',
  'class' => 'FastlyLoggingSftpGetLogSftp',
  'api_class' => 'LoggingSftpApi',
  'method_name' => 'getLogSftp',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/sftp/{logging_sftp_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an SFTP log endpoint',
  'description' => 'Get an SFTP log endpoint',
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
    'logging_sftp_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_sftp_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_sftp_name' => 'logging_sftp_name',
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

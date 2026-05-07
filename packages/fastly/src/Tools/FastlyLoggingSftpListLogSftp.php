<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List SFTP log endpoints
 *
 * Maps to Fastly generated client operation LoggingSftpApi::listLogSftp (GET /service/{service_id}/version/{version_id}/logging/sftp).
 */
class FastlyLoggingSftpListLogSftp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_sftp_list_log_sftp';
    protected const DESCRIPTION = 'List SFTP log endpoints

Official Fastly client operation: LoggingSftpApi::listLogSftp
Endpoint: GET /service/{service_id}/version/{version_id}/logging/sftp

List SFTP log endpoints';
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
  'slug' => 'fastly_logging_sftp_list_log_sftp',
  'class' => 'FastlyLoggingSftpListLogSftp',
  'api_class' => 'LoggingSftpApi',
  'method_name' => 'listLogSftp',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/sftp',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List SFTP log endpoints',
  'description' => 'List SFTP log endpoints',
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

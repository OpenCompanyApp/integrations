<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete an SFTP log endpoint
 *
 * Maps to Fastly generated client operation LoggingSftpApi::deleteLogSftp (DELETE /service/{service_id}/version/{version_id}/logging/sftp/{logging_sftp_name}).
 */
class FastlyLoggingSftpDeleteLogSftp extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_sftp_delete_log_sftp';
    protected const DESCRIPTION = 'Delete an SFTP log endpoint

Official Fastly client operation: LoggingSftpApi::deleteLogSftp
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/sftp/{logging_sftp_name}

Delete an SFTP log endpoint';
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
  'slug' => 'fastly_logging_sftp_delete_log_sftp',
  'class' => 'FastlyLoggingSftpDeleteLogSftp',
  'api_class' => 'LoggingSftpApi',
  'method_name' => 'deleteLogSftp',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/sftp/{logging_sftp_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete an SFTP log endpoint',
  'description' => 'Delete an SFTP log endpoint',
  'type' => 'write',
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

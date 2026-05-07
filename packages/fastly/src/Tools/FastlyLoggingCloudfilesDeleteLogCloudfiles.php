<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete the Cloud Files log endpoint
 *
 * Maps to Fastly generated client operation LoggingCloudfilesApi::deleteLogCloudfiles (DELETE /service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}).
 */
class FastlyLoggingCloudfilesDeleteLogCloudfiles extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_cloudfiles_delete_log_cloudfiles';
    protected const DESCRIPTION = 'Delete the Cloud Files log endpoint

Official Fastly client operation: LoggingCloudfilesApi::deleteLogCloudfiles
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}

Delete the Cloud Files log endpoint';
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
  'logging_cloudfiles_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_cloudfiles_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_cloudfiles_delete_log_cloudfiles',
  'class' => 'FastlyLoggingCloudfilesDeleteLogCloudfiles',
  'api_class' => 'LoggingCloudfilesApi',
  'method_name' => 'deleteLogCloudfiles',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete the Cloud Files log endpoint',
  'description' => 'Delete the Cloud Files log endpoint',
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
    'logging_cloudfiles_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_cloudfiles_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_cloudfiles_name' => 'logging_cloudfiles_name',
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

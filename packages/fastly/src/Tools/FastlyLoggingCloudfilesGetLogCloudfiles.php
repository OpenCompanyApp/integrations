<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Cloud Files log endpoint
 *
 * Maps to Fastly generated client operation LoggingCloudfilesApi::getLogCloudfiles (GET /service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}).
 */
class FastlyLoggingCloudfilesGetLogCloudfiles extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_cloudfiles_get_log_cloudfiles';
    protected const DESCRIPTION = 'Get a Cloud Files log endpoint

Official Fastly client operation: LoggingCloudfilesApi::getLogCloudfiles
Endpoint: GET /service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}

Get a Cloud Files log endpoint';
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
  'slug' => 'fastly_logging_cloudfiles_get_log_cloudfiles',
  'class' => 'FastlyLoggingCloudfilesGetLogCloudfiles',
  'api_class' => 'LoggingCloudfilesApi',
  'method_name' => 'getLogCloudfiles',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/cloudfiles/{logging_cloudfiles_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Cloud Files log endpoint',
  'description' => 'Get a Cloud Files log endpoint',
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

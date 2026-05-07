<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Cloud Files log endpoints
 *
 * Maps to Fastly generated client operation LoggingCloudfilesApi::listLogCloudfiles (GET /service/{service_id}/version/{version_id}/logging/cloudfiles).
 */
class FastlyLoggingCloudfilesListLogCloudfiles extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_cloudfiles_list_log_cloudfiles';
    protected const DESCRIPTION = 'List Cloud Files log endpoints

Official Fastly client operation: LoggingCloudfilesApi::listLogCloudfiles
Endpoint: GET /service/{service_id}/version/{version_id}/logging/cloudfiles

List Cloud Files log endpoints';
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
  'slug' => 'fastly_logging_cloudfiles_list_log_cloudfiles',
  'class' => 'FastlyLoggingCloudfilesListLogCloudfiles',
  'api_class' => 'LoggingCloudfilesApi',
  'method_name' => 'listLogCloudfiles',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/cloudfiles',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Cloud Files log endpoints',
  'description' => 'List Cloud Files log endpoints',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Scalyr log endpoints
 *
 * Maps to Fastly generated client operation LoggingScalyrApi::listLogScalyr (GET /service/{service_id}/version/{version_id}/logging/scalyr).
 */
class FastlyLoggingScalyrListLogScalyr extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_scalyr_list_log_scalyr';
    protected const DESCRIPTION = 'List Scalyr log endpoints

Official Fastly client operation: LoggingScalyrApi::listLogScalyr
Endpoint: GET /service/{service_id}/version/{version_id}/logging/scalyr

List Scalyr log endpoints';
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
  'slug' => 'fastly_logging_scalyr_list_log_scalyr',
  'class' => 'FastlyLoggingScalyrListLogScalyr',
  'api_class' => 'LoggingScalyrApi',
  'method_name' => 'listLogScalyr',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/scalyr',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Scalyr log endpoints',
  'description' => 'List Scalyr log endpoints',
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

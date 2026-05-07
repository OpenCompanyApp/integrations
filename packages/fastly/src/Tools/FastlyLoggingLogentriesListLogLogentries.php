<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Logentries log endpoints
 *
 * Maps to Fastly generated client operation LoggingLogentriesApi::listLogLogentries (GET /service/{service_id}/version/{version_id}/logging/logentries).
 */
class FastlyLoggingLogentriesListLogLogentries extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_logentries_list_log_logentries';
    protected const DESCRIPTION = 'List Logentries log endpoints

Official Fastly client operation: LoggingLogentriesApi::listLogLogentries
Endpoint: GET /service/{service_id}/version/{version_id}/logging/logentries

List Logentries log endpoints';
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
  'slug' => 'fastly_logging_logentries_list_log_logentries',
  'class' => 'FastlyLoggingLogentriesListLogLogentries',
  'api_class' => 'LoggingLogentriesApi',
  'method_name' => 'listLogLogentries',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/logentries',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Logentries log endpoints',
  'description' => 'List Logentries log endpoints',
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

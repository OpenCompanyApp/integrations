<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Splunk log endpoints
 *
 * Maps to Fastly generated client operation LoggingSplunkApi::listLogSplunk (GET /service/{service_id}/version/{version_id}/logging/splunk).
 */
class FastlyLoggingSplunkListLogSplunk extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_splunk_list_log_splunk';
    protected const DESCRIPTION = 'List Splunk log endpoints

Official Fastly client operation: LoggingSplunkApi::listLogSplunk
Endpoint: GET /service/{service_id}/version/{version_id}/logging/splunk

List Splunk log endpoints';
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
  'slug' => 'fastly_logging_splunk_list_log_splunk',
  'class' => 'FastlyLoggingSplunkListLogSplunk',
  'api_class' => 'LoggingSplunkApi',
  'method_name' => 'listLogSplunk',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/splunk',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Splunk log endpoints',
  'description' => 'List Splunk log endpoints',
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

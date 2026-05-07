<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Splunk log endpoint
 *
 * Maps to Fastly generated client operation LoggingSplunkApi::getLogSplunk (GET /service/{service_id}/version/{version_id}/logging/splunk/{logging_splunk_name}).
 */
class FastlyLoggingSplunkGetLogSplunk extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_splunk_get_log_splunk';
    protected const DESCRIPTION = 'Get a Splunk log endpoint

Official Fastly client operation: LoggingSplunkApi::getLogSplunk
Endpoint: GET /service/{service_id}/version/{version_id}/logging/splunk/{logging_splunk_name}

Get a Splunk log endpoint';
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
  'logging_splunk_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_splunk_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_splunk_get_log_splunk',
  'class' => 'FastlyLoggingSplunkGetLogSplunk',
  'api_class' => 'LoggingSplunkApi',
  'method_name' => 'getLogSplunk',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/splunk/{logging_splunk_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Splunk log endpoint',
  'description' => 'Get a Splunk log endpoint',
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
    'logging_splunk_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_splunk_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_splunk_name' => 'logging_splunk_name',
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

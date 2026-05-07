<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a Splunk log endpoint
 *
 * Maps to Fastly generated client operation LoggingSplunkApi::deleteLogSplunk (DELETE /service/{service_id}/version/{version_id}/logging/splunk/{logging_splunk_name}).
 */
class FastlyLoggingSplunkDeleteLogSplunk extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_splunk_delete_log_splunk';
    protected const DESCRIPTION = 'Delete a Splunk log endpoint

Official Fastly client operation: LoggingSplunkApi::deleteLogSplunk
Endpoint: DELETE /service/{service_id}/version/{version_id}/logging/splunk/{logging_splunk_name}

Delete a Splunk log endpoint';
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
  'slug' => 'fastly_logging_splunk_delete_log_splunk',
  'class' => 'FastlyLoggingSplunkDeleteLogSplunk',
  'api_class' => 'LoggingSplunkApi',
  'method_name' => 'deleteLogSplunk',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/logging/splunk/{logging_splunk_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a Splunk log endpoint',
  'description' => 'Delete a Splunk log endpoint',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a Splunk log endpoint
 *
 * Maps to Fastly generated client operation LoggingSplunkApi::createLogSplunk (POST /service/{service_id}/version/{version_id}/logging/splunk).
 */
class FastlyLoggingSplunkCreateLogSplunk extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_splunk_create_log_splunk';
    protected const DESCRIPTION = 'Create a Splunk log endpoint

Official Fastly client operation: LoggingSplunkApi::createLogSplunk
Endpoint: POST /service/{service_id}/version/{version_id}/logging/splunk

Create a Splunk log endpoint';
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
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'placement' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `placement`.',
  ),
  'response_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `response_condition`.',
  ),
  'format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format`.',
  ),
  'log_processing_region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `log_processing_region`.',
  ),
  'format_version' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `format_version`.',
  ),
  'tls_ca_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_ca_cert`.',
  ),
  'tls_client_cert' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_client_cert`.',
  ),
  'tls_client_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_client_key`.',
  ),
  'tls_hostname' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `tls_hostname`.',
  ),
  'request_max_entries' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `request_max_entries`.',
  ),
  'request_max_bytes' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `request_max_bytes`.',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `url`.',
  ),
  'token' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `token`.',
  ),
  'use_tls' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `use_tls`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_splunk_create_log_splunk',
  'class' => 'FastlyLoggingSplunkCreateLogSplunk',
  'api_class' => 'LoggingSplunkApi',
  'method_name' => 'createLogSplunk',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/logging/splunk',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a Splunk log endpoint',
  'description' => 'Create a Splunk log endpoint',
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
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'placement' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `placement`.',
    ),
    'response_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `response_condition`.',
    ),
    'format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format`.',
    ),
    'log_processing_region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `log_processing_region`.',
    ),
    'format_version' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `format_version`.',
    ),
    'tls_ca_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_ca_cert`.',
    ),
    'tls_client_cert' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_client_cert`.',
    ),
    'tls_client_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_client_key`.',
    ),
    'tls_hostname' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `tls_hostname`.',
    ),
    'request_max_entries' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `request_max_entries`.',
    ),
    'request_max_bytes' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `request_max_bytes`.',
    ),
    'url' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `url`.',
    ),
    'token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `token`.',
    ),
    'use_tls' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `use_tls`.',
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
    'name' => 'name',
    'placement' => 'placement',
    'response_condition' => 'response_condition',
    'format' => 'format',
    'log_processing_region' => 'log_processing_region',
    'format_version' => 'format_version',
    'tls_ca_cert' => 'tls_ca_cert',
    'tls_client_cert' => 'tls_client_cert',
    'tls_client_key' => 'tls_client_key',
    'tls_hostname' => 'tls_hostname',
    'request_max_entries' => 'request_max_entries',
    'request_max_bytes' => 'request_max_bytes',
    'url' => 'url',
    'token' => 'token',
    'use_tls' => 'use_tls',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

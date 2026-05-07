<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an HTTPS log endpoint
 *
 * Maps to Fastly generated client operation LoggingHttpsApi::updateLogHttps (PUT /service/{service_id}/version/{version_id}/logging/https/{logging_https_name}).
 */
class FastlyLoggingHttpsUpdateLogHttps extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_https_update_log_https';
    protected const DESCRIPTION = 'Update an HTTPS log endpoint

Official Fastly client operation: LoggingHttpsApi::updateLogHttps
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/https/{logging_https_name}

Update an HTTPS log endpoint';
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
  'logging_https_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_https_name`.',
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
  'content_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `content_type`.',
  ),
  'header_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `header_name`.',
  ),
  'message_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `message_type`.',
  ),
  'header_value' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `header_value`.',
  ),
  'method' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `method`.',
  ),
  'json_format' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `json_format`.',
  ),
  'period' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `period`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_https_update_log_https',
  'class' => 'FastlyLoggingHttpsUpdateLogHttps',
  'api_class' => 'LoggingHttpsApi',
  'method_name' => 'updateLogHttps',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/https/{logging_https_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an HTTPS log endpoint',
  'description' => 'Update an HTTPS log endpoint',
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
    'logging_https_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_https_name`.',
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
    'content_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `content_type`.',
    ),
    'header_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `header_name`.',
    ),
    'message_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `message_type`.',
    ),
    'header_value' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `header_value`.',
    ),
    'method' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `method`.',
    ),
    'json_format' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `json_format`.',
    ),
    'period' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `period`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_https_name' => 'logging_https_name',
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
    'content_type' => 'content_type',
    'header_name' => 'header_name',
    'message_type' => 'message_type',
    'header_value' => 'header_value',
    'method' => 'method',
    'json_format' => 'json_format',
    'period' => 'period',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

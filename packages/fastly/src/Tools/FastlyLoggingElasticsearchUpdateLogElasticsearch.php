<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update an Elasticsearch log endpoint
 *
 * Maps to Fastly generated client operation LoggingElasticsearchApi::updateLogElasticsearch (PUT /service/{service_id}/version/{version_id}/logging/elasticsearch/{logging_elasticsearch_name}).
 */
class FastlyLoggingElasticsearchUpdateLogElasticsearch extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_elasticsearch_update_log_elasticsearch';
    protected const DESCRIPTION = 'Update an Elasticsearch log endpoint

Official Fastly client operation: LoggingElasticsearchApi::updateLogElasticsearch
Endpoint: PUT /service/{service_id}/version/{version_id}/logging/elasticsearch/{logging_elasticsearch_name}

Update an Elasticsearch log endpoint';
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
  'logging_elasticsearch_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_elasticsearch_name`.',
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
  'index' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `index`.',
  ),
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `url`.',
  ),
  'pipeline' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `pipeline`.',
  ),
  'user' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `user`.',
  ),
  'password' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `password`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_elasticsearch_update_log_elasticsearch',
  'class' => 'FastlyLoggingElasticsearchUpdateLogElasticsearch',
  'api_class' => 'LoggingElasticsearchApi',
  'method_name' => 'updateLogElasticsearch',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/logging/elasticsearch/{logging_elasticsearch_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update an Elasticsearch log endpoint',
  'description' => 'Update an Elasticsearch log endpoint',
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
    'logging_elasticsearch_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_elasticsearch_name`.',
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
    'index' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `index`.',
    ),
    'url' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `url`.',
    ),
    'pipeline' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `pipeline`.',
    ),
    'user' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `user`.',
    ),
    'password' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `password`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_elasticsearch_name' => 'logging_elasticsearch_name',
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
    'index' => 'index',
    'url' => 'url',
    'pipeline' => 'pipeline',
    'user' => 'user',
    'password' => 'password',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

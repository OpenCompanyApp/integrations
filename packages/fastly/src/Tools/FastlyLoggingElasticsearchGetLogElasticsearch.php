<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get an Elasticsearch log endpoint
 *
 * Maps to Fastly generated client operation LoggingElasticsearchApi::getLogElasticsearch (GET /service/{service_id}/version/{version_id}/logging/elasticsearch/{logging_elasticsearch_name}).
 */
class FastlyLoggingElasticsearchGetLogElasticsearch extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_elasticsearch_get_log_elasticsearch';
    protected const DESCRIPTION = 'Get an Elasticsearch log endpoint

Official Fastly client operation: LoggingElasticsearchApi::getLogElasticsearch
Endpoint: GET /service/{service_id}/version/{version_id}/logging/elasticsearch/{logging_elasticsearch_name}

Get an Elasticsearch log endpoint';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_elasticsearch_get_log_elasticsearch',
  'class' => 'FastlyLoggingElasticsearchGetLogElasticsearch',
  'api_class' => 'LoggingElasticsearchApi',
  'method_name' => 'getLogElasticsearch',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/elasticsearch/{logging_elasticsearch_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get an Elasticsearch log endpoint',
  'description' => 'Get an Elasticsearch log endpoint',
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
    'logging_elasticsearch_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_elasticsearch_name`.',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

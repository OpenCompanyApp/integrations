<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Elasticsearch log endpoints
 *
 * Maps to Fastly generated client operation LoggingElasticsearchApi::listLogElasticsearch (GET /service/{service_id}/version/{version_id}/logging/elasticsearch).
 */
class FastlyLoggingElasticsearchListLogElasticsearch extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_elasticsearch_list_log_elasticsearch';
    protected const DESCRIPTION = 'List Elasticsearch log endpoints

Official Fastly client operation: LoggingElasticsearchApi::listLogElasticsearch
Endpoint: GET /service/{service_id}/version/{version_id}/logging/elasticsearch

List Elasticsearch log endpoints';
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
  'slug' => 'fastly_logging_elasticsearch_list_log_elasticsearch',
  'class' => 'FastlyLoggingElasticsearchListLogElasticsearch',
  'api_class' => 'LoggingElasticsearchApi',
  'method_name' => 'listLogElasticsearch',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/elasticsearch',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Elasticsearch log endpoints',
  'description' => 'List Elasticsearch log endpoints',
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

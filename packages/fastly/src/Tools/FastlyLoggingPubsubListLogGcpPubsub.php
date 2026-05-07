<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List GCP Cloud Pub/Sub log endpoints
 *
 * Maps to Fastly generated client operation LoggingPubsubApi::listLogGcpPubsub (GET /service/{service_id}/version/{version_id}/logging/pubsub).
 */
class FastlyLoggingPubsubListLogGcpPubsub extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_pubsub_list_log_gcp_pubsub';
    protected const DESCRIPTION = 'List GCP Cloud Pub/Sub log endpoints

Official Fastly client operation: LoggingPubsubApi::listLogGcpPubsub
Endpoint: GET /service/{service_id}/version/{version_id}/logging/pubsub

List GCP Cloud Pub/Sub log endpoints';
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
  'slug' => 'fastly_logging_pubsub_list_log_gcp_pubsub',
  'class' => 'FastlyLoggingPubsubListLogGcpPubsub',
  'api_class' => 'LoggingPubsubApi',
  'method_name' => 'listLogGcpPubsub',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/pubsub',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List GCP Cloud Pub/Sub log endpoints',
  'description' => 'List GCP Cloud Pub/Sub log endpoints',
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

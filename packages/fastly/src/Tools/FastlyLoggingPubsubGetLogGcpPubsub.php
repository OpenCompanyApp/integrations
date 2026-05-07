<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a GCP Cloud Pub/Sub log endpoint
 *
 * Maps to Fastly generated client operation LoggingPubsubApi::getLogGcpPubsub (GET /service/{service_id}/version/{version_id}/logging/pubsub/{logging_google_pubsub_name}).
 */
class FastlyLoggingPubsubGetLogGcpPubsub extends AbstractFastlyTool
{
    protected const NAME = 'fastly_logging_pubsub_get_log_gcp_pubsub';
    protected const DESCRIPTION = 'Get a GCP Cloud Pub/Sub log endpoint

Official Fastly client operation: LoggingPubsubApi::getLogGcpPubsub
Endpoint: GET /service/{service_id}/version/{version_id}/logging/pubsub/{logging_google_pubsub_name}

Get a GCP Cloud Pub/Sub log endpoint';
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
  'logging_google_pubsub_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `logging_google_pubsub_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_logging_pubsub_get_log_gcp_pubsub',
  'class' => 'FastlyLoggingPubsubGetLogGcpPubsub',
  'api_class' => 'LoggingPubsubApi',
  'method_name' => 'getLogGcpPubsub',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/logging/pubsub/{logging_google_pubsub_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a GCP Cloud Pub/Sub log endpoint',
  'description' => 'Get a GCP Cloud Pub/Sub log endpoint',
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
    'logging_google_pubsub_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `logging_google_pubsub_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'logging_google_pubsub_name' => 'logging_google_pubsub_name',
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

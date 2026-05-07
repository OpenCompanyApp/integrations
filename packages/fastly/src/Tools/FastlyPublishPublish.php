<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Send messages to Fanout subscribers
 *
 * Maps to Fastly generated client operation PublishApi::publish (POST /service/{service_id}/publish/).
 */
class FastlyPublishPublish extends AbstractFastlyTool
{
    protected const NAME = 'fastly_publish_publish';
    protected const DESCRIPTION = 'Send messages to Fanout subscribers

Official Fastly client operation: PublishApi::publish
Endpoint: POST /service/{service_id}/publish/

Send messages to Fanout subscribers';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'publish_request' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `publish_request`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_publish_publish',
  'class' => 'FastlyPublishPublish',
  'api_class' => 'PublishApi',
  'method_name' => 'publish',
  'method' => 'POST',
  'path' => '/service/{service_id}/publish/',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Send messages to Fanout subscribers',
  'description' => 'Send messages to Fanout subscribers',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'publish_request' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `publish_request`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
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
  'body_param' => 'publish_request',
  'body_required' => false,
);
}

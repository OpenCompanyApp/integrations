<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a rate limiter
 *
 * Maps to Fastly generated client operation RateLimiterApi::createRateLimiter (POST /service/{service_id}/version/{version_id}/rate-limiters).
 */
class FastlyRateLimiterCreateRateLimiter extends AbstractFastlyTool
{
    protected const NAME = 'fastly_rate_limiter_create_rate_limiter';
    protected const DESCRIPTION = 'Create a rate limiter

Official Fastly client operation: RateLimiterApi::createRateLimiter
Endpoint: POST /service/{service_id}/version/{version_id}/rate-limiters

Create a rate limiter';
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
  'uri_dictionary_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `uri_dictionary_name`.',
  ),
  'http_methods' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `http_methods`.',
  ),
  'rps_limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `rps_limit`.',
  ),
  'window_size' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `window_size`.',
  ),
  'client_key' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `client_key`.',
  ),
  'penalty_box_duration' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `penalty_box_duration`.',
  ),
  'action' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `action`.',
  ),
  'response_object_name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `response_object_name`.',
  ),
  'logger_type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `logger_type`.',
  ),
  'feature_revision' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `feature_revision`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_rate_limiter_create_rate_limiter',
  'class' => 'FastlyRateLimiterCreateRateLimiter',
  'api_class' => 'RateLimiterApi',
  'method_name' => 'createRateLimiter',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/rate-limiters',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a rate limiter',
  'description' => 'Create a rate limiter',
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
    'uri_dictionary_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `uri_dictionary_name`.',
    ),
    'http_methods' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `http_methods`.',
    ),
    'rps_limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `rps_limit`.',
    ),
    'window_size' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `window_size`.',
    ),
    'client_key' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `client_key`.',
    ),
    'penalty_box_duration' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `penalty_box_duration`.',
    ),
    'action' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `action`.',
    ),
    'response_object_name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `response_object_name`.',
    ),
    'logger_type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `logger_type`.',
    ),
    'feature_revision' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `feature_revision`.',
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
    'uri_dictionary_name' => 'uri_dictionary_name',
    'http_methods' => 'http_methods',
    'rps_limit' => 'rps_limit',
    'window_size' => 'window_size',
    'client_key' => 'client_key',
    'penalty_box_duration' => 'penalty_box_duration',
    'action' => 'action',
    'response_object_name' => 'response_object_name',
    'logger_type' => 'logger_type',
    'feature_revision' => 'feature_revision',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

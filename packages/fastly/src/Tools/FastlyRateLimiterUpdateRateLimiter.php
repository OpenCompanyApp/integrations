<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a rate limiter
 *
 * Maps to Fastly generated client operation RateLimiterApi::updateRateLimiter (PUT /rate-limiters/{rate_limiter_id}).
 */
class FastlyRateLimiterUpdateRateLimiter extends AbstractFastlyTool
{
    protected const NAME = 'fastly_rate_limiter_update_rate_limiter';
    protected const DESCRIPTION = 'Update a rate limiter

Official Fastly client operation: RateLimiterApi::updateRateLimiter
Endpoint: PUT /rate-limiters/{rate_limiter_id}

Update a rate limiter';
    protected const PARAMETERS = array (
  'rate_limiter_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `rate_limiter_id`.',
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
  'slug' => 'fastly_rate_limiter_update_rate_limiter',
  'class' => 'FastlyRateLimiterUpdateRateLimiter',
  'api_class' => 'RateLimiterApi',
  'method_name' => 'updateRateLimiter',
  'method' => 'PUT',
  'path' => '/rate-limiters/{rate_limiter_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a rate limiter',
  'description' => 'Update a rate limiter',
  'type' => 'write',
  'parameters' =>
  array (
    'rate_limiter_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `rate_limiter_id`.',
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
    'rate_limiter_id' => 'rate_limiter_id',
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

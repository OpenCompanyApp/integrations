<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a rate limiter
 *
 * Maps to Fastly generated client operation RateLimiterApi::getRateLimiter (GET /rate-limiters/{rate_limiter_id}).
 */
class FastlyRateLimiterGetRateLimiter extends AbstractFastlyTool
{
    protected const NAME = 'fastly_rate_limiter_get_rate_limiter';
    protected const DESCRIPTION = 'Get a rate limiter

Official Fastly client operation: RateLimiterApi::getRateLimiter
Endpoint: GET /rate-limiters/{rate_limiter_id}

Get a rate limiter';
    protected const PARAMETERS = array (
  'rate_limiter_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `rate_limiter_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_rate_limiter_get_rate_limiter',
  'class' => 'FastlyRateLimiterGetRateLimiter',
  'api_class' => 'RateLimiterApi',
  'method_name' => 'getRateLimiter',
  'method' => 'GET',
  'path' => '/rate-limiters/{rate_limiter_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a rate limiter',
  'description' => 'Get a rate limiter',
  'type' => 'read',
  'parameters' =>
  array (
    'rate_limiter_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `rate_limiter_id`.',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}

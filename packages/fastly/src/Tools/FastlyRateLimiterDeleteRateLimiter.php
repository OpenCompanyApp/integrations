<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a rate limiter
 *
 * Maps to Fastly generated client operation RateLimiterApi::deleteRateLimiter (DELETE /rate-limiters/{rate_limiter_id}).
 */
class FastlyRateLimiterDeleteRateLimiter extends AbstractFastlyTool
{
    protected const NAME = 'fastly_rate_limiter_delete_rate_limiter';
    protected const DESCRIPTION = 'Delete a rate limiter

Official Fastly client operation: RateLimiterApi::deleteRateLimiter
Endpoint: DELETE /rate-limiters/{rate_limiter_id}

Delete a rate limiter';
    protected const PARAMETERS = array (
  'rate_limiter_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `rate_limiter_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_rate_limiter_delete_rate_limiter',
  'class' => 'FastlyRateLimiterDeleteRateLimiter',
  'api_class' => 'RateLimiterApi',
  'method_name' => 'deleteRateLimiter',
  'method' => 'DELETE',
  'path' => '/rate-limiters/{rate_limiter_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a rate limiter',
  'description' => 'Delete a rate limiter',
  'type' => 'write',
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

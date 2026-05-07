<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List rate limiters
 *
 * Maps to Fastly generated client operation RateLimiterApi::listRateLimiters (GET /service/{service_id}/version/{version_id}/rate-limiters).
 */
class FastlyRateLimiterListRateLimiters extends AbstractFastlyTool
{
    protected const NAME = 'fastly_rate_limiter_list_rate_limiters';
    protected const DESCRIPTION = 'List rate limiters

Official Fastly client operation: RateLimiterApi::listRateLimiters
Endpoint: GET /service/{service_id}/version/{version_id}/rate-limiters

List rate limiters';
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
  'slug' => 'fastly_rate_limiter_list_rate_limiters',
  'class' => 'FastlyRateLimiterListRateLimiters',
  'api_class' => 'RateLimiterApi',
  'method_name' => 'listRateLimiters',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/rate-limiters',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List rate limiters',
  'description' => 'List rate limiters',
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

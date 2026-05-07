<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get usage statistics per service
 *
 * Maps to Fastly generated client operation HistoricalApi::getUsageService (GET /stats/usage_by_service).
 */
class FastlyHistoricalGetUsageService extends AbstractFastlyTool
{
    protected const NAME = 'fastly_historical_get_usage_service';
    protected const DESCRIPTION = 'Get usage statistics per service

Official Fastly client operation: HistoricalApi::getUsageService
Endpoint: GET /stats/usage_by_service

Get usage statistics per service';
    protected const PARAMETERS = array (
  'from' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `from`.',
  ),
  'to' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `to`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_historical_get_usage_service',
  'class' => 'FastlyHistoricalGetUsageService',
  'api_class' => 'HistoricalApi',
  'method_name' => 'getUsageService',
  'method' => 'GET',
  'path' => '/stats/usage_by_service',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get usage statistics per service',
  'description' => 'Get usage statistics per service',
  'type' => 'read',
  'parameters' =>
  array (
    'from' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `from`.',
    ),
    'to' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `to`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'from' => 'from',
    'to' => 'to',
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

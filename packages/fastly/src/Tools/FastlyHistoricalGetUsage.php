<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get usage statistics
 *
 * Maps to Fastly generated client operation HistoricalApi::getUsage (GET /stats/usage).
 */
class FastlyHistoricalGetUsage extends AbstractFastlyTool
{
    protected const NAME = 'fastly_historical_get_usage';
    protected const DESCRIPTION = 'Get usage statistics

Official Fastly client operation: HistoricalApi::getUsage
Endpoint: GET /stats/usage

Get usage statistics';
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
  'slug' => 'fastly_historical_get_usage',
  'class' => 'FastlyHistoricalGetUsage',
  'api_class' => 'HistoricalApi',
  'method_name' => 'getUsage',
  'method' => 'GET',
  'path' => '/stats/usage',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get usage statistics',
  'description' => 'Get usage statistics',
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

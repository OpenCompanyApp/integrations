<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get historical stats
 *
 * Maps to Fastly generated client operation HistoricalApi::getHistStats (GET /stats).
 */
class FastlyHistoricalGetHistStats extends AbstractFastlyTool
{
    protected const NAME = 'fastly_historical_get_hist_stats';
    protected const DESCRIPTION = 'Get historical stats

Official Fastly client operation: HistoricalApi::getHistStats
Endpoint: GET /stats

Get historical stats';
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
  'by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `by`.',
  ),
  'region' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `region`.',
  ),
  'datacenter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `datacenter`.',
  ),
  'services' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `services`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_historical_get_hist_stats',
  'class' => 'FastlyHistoricalGetHistStats',
  'api_class' => 'HistoricalApi',
  'method_name' => 'getHistStats',
  'method' => 'GET',
  'path' => '/stats',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get historical stats',
  'description' => 'Get historical stats',
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
    'by' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `by`.',
    ),
    'region' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `region`.',
    ),
    'datacenter' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `datacenter`.',
    ),
    'services' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `services`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'from' => 'from',
    'to' => 'to',
    'by' => 'by',
    'region' => 'region',
    'datacenter' => 'datacenter',
    'services' => 'services',
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

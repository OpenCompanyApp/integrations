<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get historical stats for a single field
 *
 * Maps to Fastly generated client operation HistoricalApi::getHistStatsField (GET /stats/field/{field}).
 */
class FastlyHistoricalGetHistStatsField extends AbstractFastlyTool
{
    protected const NAME = 'fastly_historical_get_hist_stats_field';
    protected const DESCRIPTION = 'Get historical stats for a single field

Official Fastly client operation: HistoricalApi::getHistStatsField
Endpoint: GET /stats/field/{field}

Get historical stats for a single field';
    protected const PARAMETERS = array (
  'field' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `field`.',
  ),
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_historical_get_hist_stats_field',
  'class' => 'FastlyHistoricalGetHistStatsField',
  'api_class' => 'HistoricalApi',
  'method_name' => 'getHistStatsField',
  'method' => 'GET',
  'path' => '/stats/field/{field}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get historical stats for a single field',
  'description' => 'Get historical stats for a single field',
  'type' => 'read',
  'parameters' =>
  array (
    'field' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `field`.',
    ),
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
  ),
  'path_params' =>
  array (
    'field' => 'field',
  ),
  'query_params' =>
  array (
    'from' => 'from',
    'to' => 'to',
    'by' => 'by',
    'region' => 'region',
    'datacenter' => 'datacenter',
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

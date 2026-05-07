<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get historical stats for a single service/field combination
 *
 * Maps to Fastly generated client operation HistoricalApi::getHistStatsServiceField (GET /stats/service/{service_id}/field/{field}).
 */
class FastlyHistoricalGetHistStatsServiceField extends AbstractFastlyTool
{
    protected const NAME = 'fastly_historical_get_hist_stats_service_field';
    protected const DESCRIPTION = 'Get historical stats for a single service/field combination

Official Fastly client operation: HistoricalApi::getHistStatsServiceField
Endpoint: GET /stats/service/{service_id}/field/{field}

Get historical stats for a single service/field combination';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
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
  'slug' => 'fastly_historical_get_hist_stats_service_field',
  'class' => 'FastlyHistoricalGetHistStatsServiceField',
  'api_class' => 'HistoricalApi',
  'method_name' => 'getHistStatsServiceField',
  'method' => 'GET',
  'path' => '/stats/service/{service_id}/field/{field}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get historical stats for a single service/field combination',
  'description' => 'Get historical stats for a single service/field combination',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
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
    'service_id' => 'service_id',
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

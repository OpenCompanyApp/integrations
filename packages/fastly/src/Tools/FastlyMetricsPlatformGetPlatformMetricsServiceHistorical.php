<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get historical time series metrics for a single service
 *
 * Maps to Fastly generated client operation MetricsPlatformApi::getPlatformMetricsServiceHistorical (GET /metrics/platform/services/{service_id}/{granularity}).
 */
class FastlyMetricsPlatformGetPlatformMetricsServiceHistorical extends AbstractFastlyTool
{
    protected const NAME = 'fastly_metrics_platform_get_platform_metrics_service_historical';
    protected const DESCRIPTION = 'Get historical time series metrics for a single service

Official Fastly client operation: MetricsPlatformApi::getPlatformMetricsServiceHistorical
Endpoint: GET /metrics/platform/services/{service_id}/{granularity}

Get historical time series metrics for a single service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'granularity' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `granularity`.',
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
  'metric' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `metric`.',
  ),
  'metric_set' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `metric_set`.',
  ),
  'group_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `group_by`.',
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
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_metrics_platform_get_platform_metrics_service_historical',
  'class' => 'FastlyMetricsPlatformGetPlatformMetricsServiceHistorical',
  'api_class' => 'MetricsPlatformApi',
  'method_name' => 'getPlatformMetricsServiceHistorical',
  'method' => 'GET',
  'path' => '/metrics/platform/services/{service_id}/{granularity}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get historical time series metrics for a single service',
  'description' => 'Get historical time series metrics for a single service',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'granularity' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `granularity`.',
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
    'metric' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `metric`.',
    ),
    'metric_set' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `metric_set`.',
    ),
    'group_by' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `group_by`.',
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
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'granularity' => 'granularity',
  ),
  'query_params' =>
  array (
    'from' => 'from',
    'to' => 'to',
    'metric' => 'metric',
    'metric_set' => 'metric_set',
    'group_by' => 'group_by',
    'region' => 'region',
    'datacenter' => 'datacenter',
    'cursor' => 'cursor',
    'limit' => 'limit',
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

<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get historical origin data for a service
 *
 * Maps to Fastly generated client operation OriginInspectorHistoricalApi::getOriginInspectorHistorical (GET /metrics/origins/services/{service_id}).
 */
class FastlyOriginInspectorHistoricalGetOriginInspectorHistorical extends AbstractFastlyTool
{
    protected const NAME = 'fastly_origin_inspector_historical_get_origin_inspector_historical';
    protected const DESCRIPTION = 'Get historical origin data for a service

Official Fastly client operation: OriginInspectorHistoricalApi::getOriginInspectorHistorical
Endpoint: GET /metrics/origins/services/{service_id}

Get historical origin data for a service';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'start' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `start`.',
  ),
  'end' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `end`.',
  ),
  'downsample' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `downsample`.',
  ),
  'metric' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `metric`.',
  ),
  'group_by' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `group_by`.',
  ),
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
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
  'host' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `host`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_origin_inspector_historical_get_origin_inspector_historical',
  'class' => 'FastlyOriginInspectorHistoricalGetOriginInspectorHistorical',
  'api_class' => 'OriginInspectorHistoricalApi',
  'method_name' => 'getOriginInspectorHistorical',
  'method' => 'GET',
  'path' => '/metrics/origins/services/{service_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get historical origin data for a service',
  'description' => 'Get historical origin data for a service',
  'type' => 'read',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'start' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `start`.',
    ),
    'end' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `end`.',
    ),
    'downsample' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `downsample`.',
    ),
    'metric' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `metric`.',
    ),
    'group_by' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `group_by`.',
    ),
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
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
    'host' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `host`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
  ),
  'query_params' =>
  array (
    'start' => 'start',
    'end' => 'end',
    'downsample' => 'downsample',
    'metric' => 'metric',
    'group_by' => 'group_by',
    'limit' => 'limit',
    'cursor' => 'cursor',
    'region' => 'region',
    'datacenter' => 'datacenter',
    'host' => 'host',
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

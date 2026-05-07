<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get historical domain data for a service
 *
 * Maps to Fastly generated client operation DomainInspectorHistoricalApi::getDomainInspectorHistorical (GET /metrics/domains/services/{service_id}).
 */
class FastlyDomainInspectorHistoricalGetDomainInspectorHistorical extends AbstractFastlyTool
{
    protected const NAME = 'fastly_domain_inspector_historical_get_domain_inspector_historical';
    protected const DESCRIPTION = 'Get historical domain data for a service

Official Fastly client operation: DomainInspectorHistoricalApi::getDomainInspectorHistorical
Endpoint: GET /metrics/domains/services/{service_id}

Get historical domain data for a service';
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
  'domain' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `domain`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_domain_inspector_historical_get_domain_inspector_historical',
  'class' => 'FastlyDomainInspectorHistoricalGetDomainInspectorHistorical',
  'api_class' => 'DomainInspectorHistoricalApi',
  'method_name' => 'getDomainInspectorHistorical',
  'method' => 'GET',
  'path' => '/metrics/domains/services/{service_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get historical domain data for a service',
  'description' => 'Get historical domain data for a service',
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
    'domain' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `domain`.',
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
    'domain' => 'domain',
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

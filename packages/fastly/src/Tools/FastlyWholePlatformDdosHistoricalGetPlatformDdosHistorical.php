<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get historical DDoS metrics for the entire Fastly platform
 *
 * Maps to Fastly generated client operation WholePlatformDdosHistoricalApi::getPlatformDdosHistorical (GET /metrics/platform/ddos).
 */
class FastlyWholePlatformDdosHistoricalGetPlatformDdosHistorical extends AbstractFastlyTool
{
    protected const NAME = 'fastly_whole_platform_ddos_historical_get_platform_ddos_historical';
    protected const DESCRIPTION = 'Get historical DDoS metrics for the entire Fastly platform

Official Fastly client operation: WholePlatformDdosHistoricalApi::getPlatformDdosHistorical
Endpoint: GET /metrics/platform/ddos

Get historical DDoS metrics for the entire Fastly platform';
    protected const PARAMETERS = array (
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_whole_platform_ddos_historical_get_platform_ddos_historical',
  'class' => 'FastlyWholePlatformDdosHistoricalGetPlatformDdosHistorical',
  'api_class' => 'WholePlatformDdosHistoricalApi',
  'method_name' => 'getPlatformDdosHistorical',
  'method' => 'GET',
  'path' => '/metrics/platform/ddos',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get historical DDoS metrics for the entire Fastly platform',
  'description' => 'Get historical DDoS metrics for the entire Fastly platform',
  'type' => 'read',
  'parameters' =>
  array (
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
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'start' => 'start',
    'end' => 'end',
    'downsample' => 'downsample',
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

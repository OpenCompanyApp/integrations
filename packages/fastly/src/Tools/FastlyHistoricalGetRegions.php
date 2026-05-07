<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get region codes
 *
 * Maps to Fastly generated client operation HistoricalApi::getRegions (GET /stats/regions).
 */
class FastlyHistoricalGetRegions extends AbstractFastlyTool
{
    protected const NAME = 'fastly_historical_get_regions';
    protected const DESCRIPTION = 'Get region codes

Official Fastly client operation: HistoricalApi::getRegions
Endpoint: GET /stats/regions

Get region codes';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_historical_get_regions',
  'class' => 'FastlyHistoricalGetRegions',
  'api_class' => 'HistoricalApi',
  'method_name' => 'getRegions',
  'method' => 'GET',
  'path' => '/stats/regions',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get region codes',
  'description' => 'Get region codes',
  'type' => 'read',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
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

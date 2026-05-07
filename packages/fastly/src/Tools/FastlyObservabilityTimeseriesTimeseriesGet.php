<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Retrieve observability data as a time series
 *
 * Maps to Fastly generated client operation ObservabilityTimeseriesApi::timeseriesGet (GET /observability/timeseries).
 */
class FastlyObservabilityTimeseriesTimeseriesGet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_observability_timeseries_timeseries_get';
    protected const DESCRIPTION = 'Retrieve observability data as a time series

Official Fastly client operation: ObservabilityTimeseriesApi::timeseriesGet
Endpoint: GET /observability/timeseries

Retrieve observability data as a time series';
    protected const PARAMETERS = array (
  'source' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `source`.',
  ),
  'from' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `from`.',
  ),
  'to' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `to`.',
  ),
  'granularity' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `granularity`.',
  ),
  'dimensions' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `dimensions`.',
  ),
  'filter' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `filter`.',
  ),
  'series' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `series`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_observability_timeseries_timeseries_get',
  'class' => 'FastlyObservabilityTimeseriesTimeseriesGet',
  'api_class' => 'ObservabilityTimeseriesApi',
  'method_name' => 'timeseriesGet',
  'method' => 'GET',
  'path' => '/observability/timeseries',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Retrieve observability data as a time series',
  'description' => 'Retrieve observability data as a time series',
  'type' => 'read',
  'parameters' =>
  array (
    'source' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `source`.',
    ),
    'from' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `from`.',
    ),
    'to' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `to`.',
    ),
    'granularity' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `granularity`.',
    ),
    'dimensions' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `dimensions`.',
    ),
    'filter' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `filter`.',
    ),
    'series' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `series`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'source' => 'source',
    'from' => 'from',
    'to' => 'to',
    'granularity' => 'granularity',
    'dimensions' => 'dimensions',
    'filter' => 'filter',
    'series' => 'series',
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

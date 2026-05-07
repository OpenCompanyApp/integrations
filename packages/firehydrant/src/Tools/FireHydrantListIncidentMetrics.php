<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List incident metrics and analytics.
 *
 * Maps to the official FireHydrant endpoint get /v1/metrics/incidents.
 */
class FireHydrantListIncidentMetrics extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_incident_metrics';
    protected const DESCRIPTION = 'List incident metrics and analytics

Official FireHydrant endpoint: GET /v1/metrics/incidents

Returns a report with time bucketed analytics data';
    protected const PARAMETERS = array (
  'start_date' =>
  array (
    'type' => 'string',
    'description' => 'The start date to return metrics from',
  ),
  'end_date' =>
  array (
    'type' => 'string',
    'description' => 'The end date to return metrics from',
  ),
  'bucket_size' =>
  array (
    'type' => 'string',
    'description' => 'bucket_size parameter.',
    'enum' =>
    array (
      0 => 'week',
      1 => 'day',
      2 => 'month',
      3 => 'all_time',
    ),
  ),
  'by' =>
  array (
    'type' => 'string',
    'description' => 'by parameter.',
    'enum' =>
    array (
      0 => 'total',
      1 => 'severity',
      2 => 'priority',
      3 => 'functionality',
      4 => 'service',
      5 => 'environment',
      6 => 'user',
      7 => 'user_involvement',
    ),
  ),
  'sort_field' =>
  array (
    'type' => 'string',
    'description' => 'sort_field parameter.',
    'enum' =>
    array (
      0 => 'mttd',
      1 => 'mtta',
      2 => 'mttm',
      3 => 'mttr',
      4 => 'count',
      5 => 'total_time',
    ),
  ),
  'sort_direction' =>
  array (
    'type' => 'string',
    'description' => 'sort_direction parameter.',
    'enum' =>
    array (
      0 => 'asc',
      1 => 'desc',
    ),
  ),
  'sort_limit' =>
  array (
    'type' => 'integer',
    'description' => 'sort_limit parameter.',
  ),
  'conditions' =>
  array (
    'type' => 'string',
    'description' => 'conditions parameter.',
  ),
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/metrics/incidents';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
  'start_date' => 'start_date',
  'end_date' => 'end_date',
  'bucket_size' => 'bucket_size',
  'by' => 'by',
  'sort_field' => 'sort_field',
  'sort_direction' => 'sort_direction',
  'sort_limit' => 'sort_limit',
  'conditions' => 'conditions',
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

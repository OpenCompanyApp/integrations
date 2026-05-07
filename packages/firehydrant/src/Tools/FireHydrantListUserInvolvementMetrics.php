<?php

namespace OpenCompany\Integrations\FireHydrant\Tools;

/**
 * List user metrics.
 *
 * Maps to the official FireHydrant endpoint get /v1/metrics/user_involvements.
 */
class FireHydrantListUserInvolvementMetrics extends AbstractFireHydrantTool
{
    protected const NAME = 'firehydrant_list_user_involvement_metrics';
    protected const DESCRIPTION = 'List user metrics

Official FireHydrant endpoint: GET /v1/metrics/user_involvements

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
  ),
  'by' =>
  array (
    'type' => 'string',
    'description' => 'by parameter.',
  ),
  'sort_field' =>
  array (
    'type' => 'string',
    'description' => 'sort_field parameter.',
    'enum' =>
    array (
      0 => 'user_count',
      1 => 'incident_count',
      2 => 'time_spent',
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
);
    protected const METHOD = 'get';
    protected const PATH = '/v1/metrics/user_involvements';
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
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Fetch detailed availability metrics and aggregated or non-aggregated ICMP Monitor metrics across custom time ranges. For example, you can get the p99 and p95 of latency metrics together with the packet loss percentage for any time range. Rate-limiting is applied to this endpoint, you can send 30 requests / 60 seconds at most..
 *
 * Maps to the official Checkly endpoint GET /v1/analytics/icmp/{id}.
 */
class ChecklyGetV1AnalyticsIcmpId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_analytics_icmp_id';
    protected const DESCRIPTION = 'Fetch detailed availability metrics and aggregated or non-aggregated ICMP Monitor metrics across custom time ranges. For example, you can get the p99 and p95 of latency metrics together with the packet loss percentage for any time range. Rate-limiting is applied to this endpoint, you can send 30 requests / 60 seconds at most.

Official Checkly endpoint: GET /v1/analytics/icmp/{id}.';
    protected const PARAMETERS = array (
      'id' => array (
        'type' => 'string',
        'description' => 'id parameter.',
        'required' => true,
      ),
      'from' => array (
        'type' => 'string',
        'description' => 'Custom start time of reporting window in unix timestamp format. Setting a custom "from" timestamp overrides the use of any "quickRange".',
        'required' => false,
      ),
      'to' => array (
        'type' => 'string',
        'description' => 'Custom end time of reporting window in unix timestamp format. Setting a custom "to" timestamp overrides the use of any "quickRange".',
        'required' => false,
      ),
      'quick_range' => array (
        'type' => 'string',
        'description' => 'Preset reporting windows are used for quickly generating report on commonly used windows. Can be overridden by using a custom "to" and "from" timestamp.',
        'required' => false,
        'enum' => array (
          'last24Hours',
          'last7Days',
          'last30Days',
          'thisWeek',
          'thisMonth',
          'lastWeek',
          'lastMonth',
        ),
      ),
      'aggregation_interval' => array (
        'type' => 'number',
        'description' => 'The time interval to use for aggregating metrics in minutes. For example, five minutes is 5, 24 hours is 1440.',
        'required' => false,
      ),
      'filter_by_status' => array (
        'type' => 'array',
        'description' => 'Filter based on whether a check result was either failing or passing',
        'required' => false,
      ),
      'group_by' => array (
        'type' => 'string',
        'description' => 'Determines how the series data is grouped. Note that grouped queries are a bit more expensive and might take longer.',
        'required' => false,
        'enum' => array (
          'runLocation',
        ),
      ),
      'metrics' => array (
        'type' => 'array',
        'description' => 'Available metrics for ICMP Monitors. You can pass multiple metrics as a comma separated string.',
        'required' => true,
      ),
      'limit' => array (
        'type' => 'integer',
        'description' => 'Limit the number of results',
        'required' => false,
      ),
      'page' => array (
        'type' => 'number',
        'description' => 'Page number',
        'required' => false,
      ),
    );
    protected const METHOD = 'GET';
    protected const PATH = '/v1/analytics/icmp/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'from' => 'from',
      'to' => 'to',
      'quickRange' => 'quick_range',
      'aggregationInterval' => 'aggregation_interval',
      'filterByStatus' => 'filter_by_status',
      'groupBy' => 'group_by',
      'metrics' => 'metrics',
      'limit' => 'limit',
      'page' => 'page',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

<?php

namespace OpenCompany\Integrations\Checkly\Tools;

/**
 * Fetch detailed availability metrics and aggregated or non-aggregated Heartbeat Check metrics across custom time ranges. Rate-limiting is applied to this endpoint, you can send 600 requests / 60 seconds at most..
 *
 * Maps to the official Checkly endpoint GET /v1/analytics/heartbeat-checks/{id}.
 */
class ChecklyGetV1AnalyticsHeartbeatchecksId extends AbstractChecklyTool
{
    protected const NAME = 'checkly_get_v1_analytics_heartbeatchecks_id';
    protected const DESCRIPTION = 'Fetch detailed availability metrics and aggregated or non-aggregated Heartbeat Check metrics across custom time ranges. Rate-limiting is applied to this endpoint, you can send 600 requests / 60 seconds at most.

Official Checkly endpoint: GET /v1/analytics/heartbeat-checks/{id}.';
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
      'filter_by_status' => array (
        'type' => 'array',
        'description' => 'Filter based on whether a heartbeat request was late, early, etc.',
        'required' => false,
      ),
      'metrics' => array (
        'type' => 'array',
        'description' => 'Available metrics for Heartbeat Checks. You can pass multiple metrics as a comma separated string.',
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
    protected const PATH = '/v1/analytics/heartbeat-checks/{id}';
    protected const PATH_PARAMS = array (
      'id' => 'id',
    );
    protected const QUERY_PARAMS = array (
      'from' => 'from',
      'to' => 'to',
      'quickRange' => 'quick_range',
      'filterByStatus' => 'filter_by_status',
      'metrics' => 'metrics',
      'limit' => 'limit',
      'page' => 'page',
    );
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}

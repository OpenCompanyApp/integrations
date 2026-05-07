<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get monitor response time statistics.
 *
 * Maps to the official UptimeRobot endpoint GET /monitors/{id}/stats/response-time.
 */
class UptimeRobotMonitorsGetMonitorResponseTimeStats extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_get_monitor_response_time_stats';
    protected const DESCRIPTION = 'Get monitor response time statistics

Official UptimeRobot endpoint: GET /monitors/{id}/stats/response-time.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The monitor ID',
        ],
        'from' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Start date for statistics (ISO 8601 format). Defaults to 24 hours ago.',
        ],
        'to' => [
            'type' => 'string',
            'required' => false,
            'description' => 'End date for statistics (ISO 8601 format). Defaults to now.',
        ],
        'include_time_series' => [
            'type' => 'boolean',
            'required' => false,
            'description' => 'Whether to include time series data points in the response. Defaults to false.',
        ],
        'region' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter by region code (na, eu, as, oc). When provided, only returns data for the specified region.',
            'enum' => ['na', 'eu', 'as', 'oc', 'all'],
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/monitors/{id}/stats/response-time';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'from' => 'from',
        'to' => 'to',
        'includeTimeSeries' => 'include_time_series',
        'region' => 'region',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

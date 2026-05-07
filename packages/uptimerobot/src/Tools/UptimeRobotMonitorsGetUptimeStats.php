<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get aggregated uptime statistics.
 *
 * Maps to the official UptimeRobot endpoint GET /monitors/uptime-stats.
 */
class UptimeRobotMonitorsGetUptimeStats extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_get_uptime_stats';
    protected const DESCRIPTION = 'Get aggregated uptime statistics

Official UptimeRobot endpoint: GET /monitors/uptime-stats.';
    protected const PARAMETERS = [
        'log_limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Maximum number of log entries to return (1-500).',
        ],
        'time_frame' => [
            'type' => 'string',
            'required' => true,
            'description' => 'Timeframe for statistics. Use CUSTOM with start/end for custom range.',
            'enum' => ['DAY', 'WEEK', 'MONTH', 'DAYS_30', 'YEAR', 'ALL', 'CUSTOM'],
        ],
        'start' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Start timestamp (Unix seconds). Required when timeFrame=CUSTOM.',
        ],
        'end' => [
            'type' => 'number',
            'required' => false,
            'description' => 'End timestamp (Unix seconds). Required when timeFrame=CUSTOM. Must be > start.',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/monitors/uptime-stats';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'logLimit' => 'log_limit',
        'timeFrame' => 'time_frame',
        'start' => 'start',
        'end' => 'end',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

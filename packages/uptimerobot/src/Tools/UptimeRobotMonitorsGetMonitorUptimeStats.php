<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get monitor uptime statistics.
 *
 * Maps to the official UptimeRobot endpoint GET /monitors/{id}/stats/uptime.
 */
class UptimeRobotMonitorsGetMonitorUptimeStats extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_get_monitor_uptime_stats';
    protected const DESCRIPTION = 'Get monitor uptime statistics

Official UptimeRobot endpoint: GET /monitors/{id}/stats/uptime.';
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
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/monitors/{id}/stats/uptime';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'from' => 'from',
        'to' => 'to',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

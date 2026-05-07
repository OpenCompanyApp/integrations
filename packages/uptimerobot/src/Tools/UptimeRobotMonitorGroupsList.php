<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List monitor groups.
 *
 * Maps to the official UptimeRobot endpoint GET /monitor-groups.
 */
class UptimeRobotMonitorGroupsList extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitor_groups_list';
    protected const DESCRIPTION = 'List monitor groups

Official UptimeRobot endpoint: GET /monitor-groups.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Cursor for pagination (ID of the last item from previous page)',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/monitor-groups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

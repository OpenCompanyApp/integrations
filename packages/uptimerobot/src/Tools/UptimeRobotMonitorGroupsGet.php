<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get a monitor group by ID.
 *
 * Maps to the official UptimeRobot endpoint GET /monitor-groups/{id}.
 */
class UptimeRobotMonitorGroupsGet extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitor_groups_get';
    protected const DESCRIPTION = 'Get a monitor group by ID

Official UptimeRobot endpoint: GET /monitor-groups/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The monitor group ID',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/monitor-groups/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Update a monitor group.
 *
 * Maps to the official UptimeRobot endpoint PATCH /monitor-groups/{id}.
 */
class UptimeRobotMonitorGroupsUpdate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitor_groups_update';
    protected const DESCRIPTION = 'Update a monitor group

Official UptimeRobot endpoint: PATCH /monitor-groups/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The monitor group ID',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/monitor-groups/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

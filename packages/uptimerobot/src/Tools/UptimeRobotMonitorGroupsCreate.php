<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Create a monitor group.
 *
 * Maps to the official UptimeRobot endpoint POST /monitor-groups.
 */
class UptimeRobotMonitorGroupsCreate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitor_groups_create';
    protected const DESCRIPTION = 'Create a monitor group

Official UptimeRobot endpoint: POST /monitor-groups.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/monitor-groups';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Create a monitor.
 *
 * Maps to the official UptimeRobot endpoint POST /monitors.
 */
class UptimeRobotMonitorsCreate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_create';
    protected const DESCRIPTION = 'Create a monitor

Official UptimeRobot endpoint: POST /monitors.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/monitors';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

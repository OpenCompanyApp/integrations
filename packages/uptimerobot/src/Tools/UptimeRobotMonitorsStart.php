<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Start a monitor.
 *
 * Maps to the official UptimeRobot endpoint POST /monitors/{id}/start.
 */
class UptimeRobotMonitorsStart extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_start';
    protected const DESCRIPTION = 'Start a monitor

Official UptimeRobot endpoint: POST /monitors/{id}/start.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/monitors/{id}/start';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get a monitor by ID.
 *
 * Maps to the official UptimeRobot endpoint GET /monitors/{id}.
 */
class UptimeRobotMonitorsGet extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_get';
    protected const DESCRIPTION = 'Get a monitor by ID

Official UptimeRobot endpoint: GET /monitors/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/monitors/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

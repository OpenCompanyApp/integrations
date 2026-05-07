<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Update a monitor.
 *
 * Maps to the official UptimeRobot endpoint PATCH /monitors/{id}.
 */
class UptimeRobotMonitorsUpdate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_update';
    protected const DESCRIPTION = 'Update a monitor

Official UptimeRobot endpoint: PATCH /monitors/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/monitors/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

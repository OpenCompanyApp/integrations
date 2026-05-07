<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Pause a monitor.
 *
 * Maps to the official UptimeRobot endpoint POST /monitors/{id}/pause.
 */
class UptimeRobotMonitorsPause extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_pause';
    protected const DESCRIPTION = 'Pause a monitor

Official UptimeRobot endpoint: POST /monitors/{id}/pause.';
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
    protected const PATH = '/monitors/{id}/pause';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

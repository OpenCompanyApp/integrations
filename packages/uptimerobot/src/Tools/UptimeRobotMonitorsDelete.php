<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Delete a monitor.
 *
 * Maps to the official UptimeRobot endpoint DELETE /monitors/{id}.
 */
class UptimeRobotMonitorsDelete extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_monitors_delete';
    protected const DESCRIPTION = 'Delete a monitor

Official UptimeRobot endpoint: DELETE /monitors/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/monitors/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

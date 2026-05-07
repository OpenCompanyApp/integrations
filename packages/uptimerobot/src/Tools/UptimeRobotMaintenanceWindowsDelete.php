<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Delete a maintenance window.
 *
 * Maps to the official UptimeRobot endpoint DELETE /maintenance-windows/{id}.
 */
class UptimeRobotMaintenanceWindowsDelete extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_maintenance_windows_delete';
    protected const DESCRIPTION = 'Delete a maintenance window

Official UptimeRobot endpoint: DELETE /maintenance-windows/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/maintenance-windows/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

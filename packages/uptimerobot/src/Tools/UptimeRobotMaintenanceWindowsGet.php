<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get a maintenance window by ID.
 *
 * Maps to the official UptimeRobot endpoint GET /maintenance-windows/{id}.
 */
class UptimeRobotMaintenanceWindowsGet extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_maintenance_windows_get';
    protected const DESCRIPTION = 'Get a maintenance window by ID

Official UptimeRobot endpoint: GET /maintenance-windows/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the maintenance window',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/maintenance-windows/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

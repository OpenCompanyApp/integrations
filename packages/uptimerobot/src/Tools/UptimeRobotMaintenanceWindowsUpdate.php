<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Update a maintenance window.
 *
 * Maps to the official UptimeRobot endpoint PATCH /maintenance-windows/{id}.
 */
class UptimeRobotMaintenanceWindowsUpdate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_maintenance_windows_update';
    protected const DESCRIPTION = 'Update a maintenance window

Official UptimeRobot endpoint: PATCH /maintenance-windows/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the maintenance window',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/maintenance-windows/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

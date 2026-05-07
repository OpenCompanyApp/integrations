<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Create a maintenance window.
 *
 * Maps to the official UptimeRobot endpoint POST /maintenance-windows.
 */
class UptimeRobotMaintenanceWindowsCreate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_maintenance_windows_create';
    protected const DESCRIPTION = 'Create a maintenance window

Official UptimeRobot endpoint: POST /maintenance-windows.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/maintenance-windows';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

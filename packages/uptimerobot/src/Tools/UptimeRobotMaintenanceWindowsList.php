<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List maintenance windows.
 *
 * Maps to the official UptimeRobot endpoint GET /maintenance-windows.
 */
class UptimeRobotMaintenanceWindowsList extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_maintenance_windows_list';
    protected const DESCRIPTION = 'List maintenance windows

Official UptimeRobot endpoint: GET /maintenance-windows.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'cursor',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/maintenance-windows';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

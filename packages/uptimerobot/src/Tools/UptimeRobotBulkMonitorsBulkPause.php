<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Pause all monitors in a group.
 *
 * Maps to the official UptimeRobot endpoint POST /monitors/bulk/pause.
 */
class UptimeRobotBulkMonitorsBulkPause extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_bulk_monitors_bulk_pause';
    protected const DESCRIPTION = 'Pause all monitors in a group

Official UptimeRobot endpoint: POST /monitors/bulk/pause.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/monitors/bulk/pause';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

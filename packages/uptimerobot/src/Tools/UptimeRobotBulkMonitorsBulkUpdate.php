<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Update all monitors in a group.
 *
 * Maps to the official UptimeRobot endpoint POST /monitors/bulk/update.
 */
class UptimeRobotBulkMonitorsBulkUpdate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_bulk_monitors_bulk_update';
    protected const DESCRIPTION = 'Update all monitors in a group

Official UptimeRobot endpoint: POST /monitors/bulk/update.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/monitors/bulk/update';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

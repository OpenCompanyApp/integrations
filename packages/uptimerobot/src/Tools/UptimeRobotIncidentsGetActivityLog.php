<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get incident activity log.
 *
 * Maps to the official UptimeRobot endpoint GET /incidents/{id}/activity-log.
 */
class UptimeRobotIncidentsGetActivityLog extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_incidents_get_activity_log';
    protected const DESCRIPTION = 'Get incident activity log

Official UptimeRobot endpoint: GET /incidents/{id}/activity-log.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of the incident',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/incidents/{id}/activity-log';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

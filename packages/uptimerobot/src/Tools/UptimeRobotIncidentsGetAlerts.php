<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get incident sent alerts.
 *
 * Maps to the official UptimeRobot endpoint GET /incidents/{id}/alerts.
 */
class UptimeRobotIncidentsGetAlerts extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_incidents_get_alerts';
    protected const DESCRIPTION = 'Get incident sent alerts

Official UptimeRobot endpoint: GET /incidents/{id}/alerts.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of the incident',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/incidents/{id}/alerts';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

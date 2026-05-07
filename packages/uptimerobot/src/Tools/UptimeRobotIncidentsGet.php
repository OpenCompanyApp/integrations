<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get an incident by ID.
 *
 * Maps to the official UptimeRobot endpoint GET /incidents/{id}.
 */
class UptimeRobotIncidentsGet extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_incidents_get';
    protected const DESCRIPTION = 'Get an incident by ID

Official UptimeRobot endpoint: GET /incidents/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The incident ID',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/incidents/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

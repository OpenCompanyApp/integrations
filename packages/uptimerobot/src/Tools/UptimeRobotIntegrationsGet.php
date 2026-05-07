<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get an integration by ID.
 *
 * Maps to the official UptimeRobot endpoint GET /integrations/{id}.
 */
class UptimeRobotIntegrationsGet extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_integrations_get';
    protected const DESCRIPTION = 'Get an integration by ID

Official UptimeRobot endpoint: GET /integrations/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the integration',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/integrations/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

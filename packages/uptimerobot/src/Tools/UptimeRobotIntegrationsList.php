<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List Integrations.
 *
 * Maps to the official UptimeRobot endpoint GET /integrations.
 */
class UptimeRobotIntegrationsList extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_integrations_list';
    protected const DESCRIPTION = 'List Integrations

Official UptimeRobot endpoint: GET /integrations.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Cursor to paginate through the integrations',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/integrations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

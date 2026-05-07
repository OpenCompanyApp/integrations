<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Create an Integration.
 *
 * Maps to the official UptimeRobot endpoint POST /integrations.
 */
class UptimeRobotIntegrationsCreate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_integrations_create';
    protected const DESCRIPTION = 'Create an Integration

Official UptimeRobot endpoint: POST /integrations.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/integrations';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

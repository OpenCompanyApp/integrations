<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Update an Integration.
 *
 * Maps to the official UptimeRobot endpoint PATCH /integrations/{id}.
 */
class UptimeRobotIntegrationsUpdate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_integrations_update';
    protected const DESCRIPTION = 'Update an Integration

Official UptimeRobot endpoint: PATCH /integrations/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the integration',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/integrations/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

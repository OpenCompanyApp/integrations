<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Delete an Integration.
 *
 * Maps to the official UptimeRobot endpoint DELETE /integrations/{id}.
 */
class UptimeRobotIntegrationsDelete extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_integrations_delete';
    protected const DESCRIPTION = 'Delete an Integration

Official UptimeRobot endpoint: DELETE /integrations/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/integrations/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

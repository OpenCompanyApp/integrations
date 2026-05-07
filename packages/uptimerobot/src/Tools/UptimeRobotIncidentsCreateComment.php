<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Create incident comment.
 *
 * Maps to the official UptimeRobot endpoint POST /incidents/{id}/comments.
 */
class UptimeRobotIncidentsCreateComment extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_incidents_create_comment';
    protected const DESCRIPTION = 'Create incident comment

Official UptimeRobot endpoint: POST /incidents/{id}/comments.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of the incident',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/incidents/{id}/comments';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

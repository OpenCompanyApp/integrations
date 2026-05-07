<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Update an incident comment.
 *
 * Maps to the official UptimeRobot endpoint PATCH /incidents/{id}/comments/{commentId}.
 */
class UptimeRobotIncidentsUpdateComment extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_incidents_update_comment';
    protected const DESCRIPTION = 'Update an incident comment

Official UptimeRobot endpoint: PATCH /incidents/{id}/comments/{commentId}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The incident ID',
        ],
        'comment_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'The comment ID',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/incidents/{id}/comments/{commentId}';
    protected const PATH_PARAMS = [
        'id' => 'id',
        'commentId' => 'comment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

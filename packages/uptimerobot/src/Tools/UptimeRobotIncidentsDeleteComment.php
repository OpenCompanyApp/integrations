<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Delete incident comment.
 *
 * Maps to the official UptimeRobot endpoint DELETE /incidents/{id}/comments/{commentId}.
 */
class UptimeRobotIncidentsDeleteComment extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_incidents_delete_comment';
    protected const DESCRIPTION = 'Delete incident comment

Official UptimeRobot endpoint: DELETE /incidents/{id}/comments/{commentId}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'ID of the incident',
        ],
        'comment_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the comment',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/incidents/{id}/comments/{commentId}';
    protected const PATH_PARAMS = [
        'id' => 'id',
        'commentId' => 'comment_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List incident comments.
 *
 * Maps to the official UptimeRobot endpoint GET /incidents/{id}/comments.
 */
class UptimeRobotIncidentsListComments extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_incidents_list_comments';
    protected const DESCRIPTION = 'List incident comments

Official UptimeRobot endpoint: GET /incidents/{id}/comments.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'string',
            'required' => true,
            'description' => 'The incident ID',
        ],
        'cursor' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Cursor to paginate through comments (comment ID)',
        ],
        'limit' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Number of comments to return (1-100, default 50)',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/incidents/{id}/comments';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
        'limit' => 'limit',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

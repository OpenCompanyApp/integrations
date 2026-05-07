<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List user tags.
 *
 * Maps to the official UptimeRobot endpoint GET /tags.
 */
class UptimeRobotTagsGetTags extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_tags_get_tags';
    protected const DESCRIPTION = 'List user tags

Official UptimeRobot endpoint: GET /tags.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Cursor for pagination',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/tags';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

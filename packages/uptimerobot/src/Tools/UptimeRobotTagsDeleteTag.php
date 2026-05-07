<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Delete a tag.
 *
 * Maps to the official UptimeRobot endpoint DELETE /tags/{id}.
 */
class UptimeRobotTagsDeleteTag extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_tags_delete_tag';
    protected const DESCRIPTION = 'Delete a tag

Official UptimeRobot endpoint: DELETE /tags/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'Tag ID to delete',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/tags/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

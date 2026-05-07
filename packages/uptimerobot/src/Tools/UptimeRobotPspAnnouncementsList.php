<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List announcements.
 *
 * Maps to the official UptimeRobot endpoint GET /psps/{pspId}/announcements.
 */
class UptimeRobotPspAnnouncementsList extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_announcements_list';
    protected const DESCRIPTION = 'List announcements

Official UptimeRobot endpoint: GET /psps/{pspId}/announcements.';
    protected const PARAMETERS = [
        'psp_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the Public Status Page',
        ],
        'status' => [
            'type' => 'string',
            'required' => false,
            'description' => 'Filter announcements by status',
            'enum' => ['OFFLINE', 'PENDING', 'PUBLISHED', 'ARCHIVED'],
        ],
        'cursor' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Cursor to paginate through announcements',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/psps/{pspId}/announcements';
    protected const PATH_PARAMS = [
        'pspId' => 'psp_id',
    ];
    protected const QUERY_PARAMS = [
        'status' => 'status',
        'cursor' => 'cursor',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

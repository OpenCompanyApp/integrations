<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get an announcement by ID.
 *
 * Maps to the official UptimeRobot endpoint GET /psps/{pspId}/announcements/{id}.
 */
class UptimeRobotPspAnnouncementsGet extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_announcements_get';
    protected const DESCRIPTION = 'Get an announcement by ID

Official UptimeRobot endpoint: GET /psps/{pspId}/announcements/{id}.';
    protected const PARAMETERS = [
        'psp_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the Public Status Page',
        ],
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the announcement',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/psps/{pspId}/announcements/{id}';
    protected const PATH_PARAMS = [
        'pspId' => 'psp_id',
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

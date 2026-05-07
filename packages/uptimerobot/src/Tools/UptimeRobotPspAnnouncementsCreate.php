<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Create an announcement.
 *
 * Maps to the official UptimeRobot endpoint POST /psps/{pspId}/announcements.
 */
class UptimeRobotPspAnnouncementsCreate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_announcements_create';
    protected const DESCRIPTION = 'Create an announcement

Official UptimeRobot endpoint: POST /psps/{pspId}/announcements.';
    protected const PARAMETERS = [
        'psp_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the Public Status Page',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/psps/{pspId}/announcements';
    protected const PATH_PARAMS = [
        'pspId' => 'psp_id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

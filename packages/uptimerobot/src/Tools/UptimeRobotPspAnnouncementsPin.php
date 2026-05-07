<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Pin an announcement.
 *
 * Maps to the official UptimeRobot endpoint POST /psps/{pspId}/announcements/{id}/pin.
 */
class UptimeRobotPspAnnouncementsPin extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_announcements_pin';
    protected const DESCRIPTION = 'Pin an announcement

Official UptimeRobot endpoint: POST /psps/{pspId}/announcements/{id}/pin.';
    protected const PARAMETERS = [
        'psp_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the Public Status Page',
        ],
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the announcement to pin',
        ],
        'body' => [
            'type' => 'object',
            'required' => false,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/psps/{pspId}/announcements/{id}/pin';
    protected const PATH_PARAMS = [
        'pspId' => 'psp_id',
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

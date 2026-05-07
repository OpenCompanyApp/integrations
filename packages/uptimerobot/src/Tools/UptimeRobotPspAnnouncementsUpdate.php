<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Update an announcement.
 *
 * Maps to the official UptimeRobot endpoint PATCH /psps/{pspId}/announcements/{id}.
 */
class UptimeRobotPspAnnouncementsUpdate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_announcements_update';
    protected const DESCRIPTION = 'Update an announcement

Official UptimeRobot endpoint: PATCH /psps/{pspId}/announcements/{id}.';
    protected const PARAMETERS = [
        'psp_id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the Public Status Page',
        ],
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'ID of the announcement to update',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/psps/{pspId}/announcements/{id}';
    protected const PATH_PARAMS = [
        'pspId' => 'psp_id',
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'json';
}

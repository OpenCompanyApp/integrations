<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Update a PSP.
 *
 * Maps to the official UptimeRobot endpoint PATCH /psps/{id}.
 */
class UptimeRobotPspUpdate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_update';
    protected const DESCRIPTION = 'Update a PSP

Official UptimeRobot endpoint: PATCH /psps/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'PATCH';
    protected const PATH = '/psps/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'multipart';
}

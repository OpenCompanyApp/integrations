<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Create a PSP.
 *
 * Maps to the official UptimeRobot endpoint POST /psps.
 */
class UptimeRobotPspCreate extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_create';
    protected const DESCRIPTION = 'Create a PSP

Official UptimeRobot endpoint: POST /psps.';
    protected const PARAMETERS = [
        'body' => [
            'type' => 'object',
            'required' => true,
            'description' => 'Request body matching the official UptimeRobot OpenAPI schema.',
        ],
    ];
    protected const METHOD = 'POST';
    protected const PATH = '/psps';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = true;
    protected const BODY_CONTENT_TYPE = 'multipart';
}

<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Get a PSP by ID.
 *
 * Maps to the official UptimeRobot endpoint GET /psps/{id}.
 */
class UptimeRobotPspGet extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_get';
    protected const DESCRIPTION = 'Get a PSP by ID

Official UptimeRobot endpoint: GET /psps/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/psps/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

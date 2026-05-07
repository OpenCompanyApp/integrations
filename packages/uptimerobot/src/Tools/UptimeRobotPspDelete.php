<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * Delete a PSP.
 *
 * Maps to the official UptimeRobot endpoint DELETE /psps/{id}.
 */
class UptimeRobotPspDelete extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_delete';
    protected const DESCRIPTION = 'Delete a PSP

Official UptimeRobot endpoint: DELETE /psps/{id}.';
    protected const PARAMETERS = [
        'id' => [
            'type' => 'number',
            'required' => true,
            'description' => 'id',
        ],
    ];
    protected const METHOD = 'DELETE';
    protected const PATH = '/psps/{id}';
    protected const PATH_PARAMS = [
        'id' => 'id',
    ];
    protected const QUERY_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}

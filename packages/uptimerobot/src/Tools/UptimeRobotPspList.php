<?php

namespace OpenCompany\Integrations\UptimeRobot\Tools;

/**
 * List PSPs.
 *
 * Maps to the official UptimeRobot endpoint GET /psps.
 */
class UptimeRobotPspList extends AbstractUptimeRobotTool
{
    protected const NAME = 'uptimerobot_psp_list';
    protected const DESCRIPTION = 'List PSPs

Official UptimeRobot endpoint: GET /psps.';
    protected const PARAMETERS = [
        'cursor' => [
            'type' => 'number',
            'required' => false,
            'description' => 'Cursor to paginate through PSPs',
        ],
    ];
    protected const METHOD = 'GET';
    protected const PATH = '/psps';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [
        'cursor' => 'cursor',
    ];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'json';
}
